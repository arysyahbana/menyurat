<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            // "logo" => ["required", "file", "image", "max:2048"],
            "logo" => ["required", "string", "regex:/^data:image\/(png|jpe?g);base64,.+/i"],
            "name" => ["required", "string", "min:3"],
            "email" => ["required", "email", "unique:users,email," . auth()->user()->id . ",id"],
            "web_url" => ["nullable", "string", "url"],
            "street" => ["required", "string", "min:5", "max:50"],
            "urban_village_id" => ["required", "integer"],
            "district_id" => ["required", "integer"],
            "region_id" => ["required", "integer"],
            "province_id" => ["required", "integer"],
            "phone_number" => ["required", "min:10", "max:13", "regex:/[0]{1}[8]{1}[0-9]{0,11}/"],
        ];
    }

    public function messages()
    {
        return [
            "phone_number.regex" => ":attribute tidak valid (format: 08xx)"
        ];
    }

    public function attributes(): array
    {
        return [
            "logo" => "Logo",
            "name" => "Nama",
            "email" => "Email",
            "web_url" => "Tautan website",
            "street" => "Nama jalan",
            "urban_village_id" => "Kelurahan",
            "district_id" => "Kecamatan",
            "region_id" => "Kota/Kabupaten",
            "province_id" => "Provinsi",
            "phone_number" => "Nomor telpon",
        ];
    }
}
