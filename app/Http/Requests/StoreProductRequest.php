<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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

    
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'small_description' => ['required', 'string','max:200'],
            'description' => ['required', 'string','max:1000'],
            'picture' => ['image'],
            'price'=>['numeric','required'],
            'slug'=>['string'],
            'avaible'=> ['boolean']

        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'slug'=> Str::slug($this->name)
        ]);
    }
}
