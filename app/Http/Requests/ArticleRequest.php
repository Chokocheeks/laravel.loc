<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:20',
            'content' => 'required|min:70',
            'image' => 'file|size:512|image|' //mimes:jpg,bmp,png,gif,svg,webp
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Обязательно для заполнения',
            'name.min' => 'Поле не должно быть короче :min символов',
            'name.max' => 'Имя категории недолжно превышать :max символов',
            'content.required' => 'Обязательно для заполнения',
            'content.min' => 'Поле не должно быть короче :min символов',
            'image.file' => 'Размер файла не долже превышать 512 КБ',
            'image.image' => 'Загруженный файл не является изображением',
            'image.mimes' => 'Формат файла не корректен'

        ];
    }

    public function attributes()
    {
        return[
            'name' => 'Название Статьи',
            'content' => 'Контент'
        ];
    }
}
