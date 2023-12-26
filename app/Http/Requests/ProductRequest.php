<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    // protected function prepareForValidation()
    // {
    //     $this->merge(['price'=> preg_replace(['R',"$",' '],'',$this->price) ]);
    //     dd($this->all());
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required',
            'description'   => 'required',
            'bory'          => 'required|min:30',
            'price'         => 'required',
            'photos.*'        => 'image'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'este campo é obrigatório',
            'min'      => 'Campo deve ter no mínimo :min caracteres',
            'image'    => 'Arquivo não é uma imagemválida!'
        ];
    }
}
