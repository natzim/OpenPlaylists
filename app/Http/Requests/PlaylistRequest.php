<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PlaylistRequest extends FormRequest {

    public function rules()
    {
        return [
            'name' => 'required|not_reserved|max:100'
        ];
    }

    public function authorize()
    {
        return Auth::check();
    }

}