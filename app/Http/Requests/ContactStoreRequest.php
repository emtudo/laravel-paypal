<?php

namespace app\Http\Requests;

use App\Http\Requests\Request;

class ContactStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:1|max:255',
            'email' => 'required|min:5|max:255|email',
            'phone' => 'max:15',
            'comments' => 'required|min:2|max:65535',
        ];
    }
}
