<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MerchantUpdateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $user = User::find($request->route()->parameter('id'));
        if ($user->email == $request->email)
            return [
                'email' => 'email|unique:users,id,'.$request->route()->parameter('id'),
            ];
        else
            return [
                'email' => 'email|unique:users'
            ];
    }

}
