<?php

namespace app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function forbiddenResponse()
    {
        return response()->json(['message' => 'Forbidden!'], 403);
    }

    public function response(array $errors)
    {
        return response()->json(['message' => $errors], 403);
    }
}
