<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            //
            'title' => 'required|min:1|max:50',
            'body' => 'required|min:1|max:1000',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.max' => '５０文字以内で入力してください',
            'body.required' => '本文を入力してください',
            'body.max' => '1000文字以内で入力してください',
            'tags.regex' => 'タグ名にスペースとスラッシュ( / )を含むことはできません',
        ];
    }

    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }
}
