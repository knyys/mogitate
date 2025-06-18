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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer','min:0', 'max:10000'],
            'description' => ['required', 'string', 'max:120'],
            'season_name' => ['required', 'array'],
            'season_name.*' => ['required', 'string', 'max:255', 'exists:seasons,name'],
        ];
        
        if ($this->isMethod('post')) {
            $rules['image'] = ['required', 'mimes:png,jpeg', 'max:10240'];
        } else {
            $rules['image'] = ['nullable', 'mimes:png,jpeg', 'max:10240'];
        }

        return $rules;
    }

    public function messages()
    {
        return[
        'product_name.required' => '商品名を入力してください',
        'price.required' => '値段を入力してください',
        'price.integer' => '数値で入力してください',
        'price.min' => '0~10000円以内で入力してください',
        'price.max' => '0~10000円以内で入力してください',
        'image.required' => '商品画像を登録してください',
        'image.mimes' =>'「.png」または「.jpeg」形式でアップロードしてください',
        'description.required' => '商品説明を入力してください',
        'description.max' => '120文字以内で入力してください',
        'season_name.required' => '季節を選択してください',
        'season_name.*.required' => '季節を選択してください',
        ];
    }

}
