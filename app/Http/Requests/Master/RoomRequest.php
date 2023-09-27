<?php

namespace App\Http\Requests\Master;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
      'user_id' => [
        'required',
        'exists:users,id',
        Rule::unique('rooms', 'user_id')->ignore($this->room),
      ],
      'name' => [
        'required', 'string',
        Rule::unique('rooms', 'name')->ignore($this->room),
      ],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      '*.required' => ':attribute tidak boleh dikosongkan',
      '*.string' => ':attribute tidak valid, masukkan yang benar',
      '*.max' => ':attribute terlalu panjang, maksimal :max karakter',
      '*.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      '*.in' => ':attribute tidak sesuai dengan data kami',
      '*.exists' => ':attribute tidak ditemukan di storage kami',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'name' => 'Nama',
      'user_id' => 'Wali Kelas',
    ];
  }
}
