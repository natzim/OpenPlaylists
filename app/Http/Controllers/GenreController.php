<?php namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Support\Facades\Cache;

class GenreController extends Controller {

    /**
     * Get a multidimensional array of genres
     *
     * @return array
     */
    public function index()
    {
        if (Cache::has('genres'))
        {
            return Cache::get('genres');
        }
        else
        {
            // Only include certain information
            // We need 'id' and 'parent_id' for Baum to be able to make the structure properly
            $include = ['id', 'parent_id', 'name'];

            $genres = Genre::root()->getDescendantsAndSelf($include)->toHierarchy();

            $genres = $this->cleanup($genres->toArray())[1];

            Cache::forever('genres', $genres);

            return $genres;
        }
    }

    /**
     * Recursively renames `name` to `text` and `children` to `nodes`
     *
     * @param array $array
     *
     * @return array
     */
    private function cleanup(array $array)
    {
        foreach($array as &$value)
        {
            // Rename 'name' to 'text' and 'children' to 'nodes'
            // So it can be used by Bootstrap Treeview
            $value['text'] = $value['name'];
            $value['nodes'] = $value['children'];
            unset($value['name']);
            unset($value['children']);

            // Remove unused elements so the payload isn't too big
            unset($value['id']);
            unset($value['parent_id']);

            if (empty($value['nodes']))
            {
                // Baum creates empty children arrays even if it has no children, so let's remove them so we don't
                // confuse Bootstrap Treeview
                unset($value['nodes']);
            }
            else
            {
                $value['nodes'] = $this->cleanup($value['nodes']);
            }
        }

        return $array;
    }

}
