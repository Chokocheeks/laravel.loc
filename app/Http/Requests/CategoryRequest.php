<?php

namespace App\Http\Requests;

use App\Rules\SeriaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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


    protected function prepareForValidation()
    {
        // $this->merge([
        //     'slug' => '222'
        // ]);

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
            // 'slug' => [Rule::in([1, 2, 3, 4]), new SeriaRule()],
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Поле :attribute не должно быть короче :min символов',
            'name.required' => 'Обязательно для заполнения',
            // 'name.max' => 'Имя категории недолжно превышать 20 символов',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название категории',

        ];
    }

}
