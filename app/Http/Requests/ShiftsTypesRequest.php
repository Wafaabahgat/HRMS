<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ShiftsTypesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules(): array {
            return [
                'type'=>'required',
                'from_time'=>'required',
                'to_time'=>'required',
                'total_hours'=>'required',
                'active'=>'required',
            ];
        }

        public function messages() {
            return [
                'type.required'=>'حقل نوع الشفت مطلوب',
                'from_time.required'=>'حقل يبدا من الساعه مطلوب',
                'to_time.required'=>'حقل ينتهي الساعه مطلوب',
                'total_hours.required'=>'عدد ساعات الشفت مطلوبه',
                'active.required'=>'حاله تفعيل الشفت مطلوبه',
            ];
        }

}
