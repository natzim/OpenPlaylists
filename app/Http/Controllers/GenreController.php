<?php namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Support\Facades\Cache;

class GenreController extends Controller {

    public function index()
    {
        if (Cache::has('genres'))
        {
            return Cache::get('genres');
        }
        else
        {
            // Only include certain information
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
            $value['text'] = $value['name'];
            $value['nodes'] = $value['children'];

            unset($value['name']);
            unset($value['children']);
            unset($value['id']);
            unset($value['parent_id']);

            if (empty($value['nodes']))
            {
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
