<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchesRequest extends FormRequest {
    /**
    * Determine if the user is authorized to make this request.
    */

    public function authorize(): bool {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */

    public function rules(): array {
        return [
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'active'=>'required',
        ];
    }

    public function messages() {
        return [
            'name.required'=>'اسم الفرع مطلوب',
            'phone.required'=>'رقم الفرع مطلوب',
            'address.required'=>'عنوان الفرع مطلوب',
            'active.required'=>'حاله تفعيل الفرع مطلوبه',
        ];
    }

}
