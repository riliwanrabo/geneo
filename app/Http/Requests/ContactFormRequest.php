<?php

namespace App\Http\Requests;

use App\Rules\ThrottleSubmission;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ContactFormRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'name' => ['required'],
            'message' => ['required', 'min:2', 'max:2000'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $request = $this->request;
        if ($request->has('file')) {
            ['file' => $file] = $this->request->all();
            // unlink file
            unlink(public_path($file));
        }
    }

}
