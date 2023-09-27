<?php

namespace App\Http\Requests;

use App\Helpers\Enums\GenderType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
      'name' => 'required|string|max:50',
      'email' => [
        'required', 'email:dns',
        Rule::unique('students', 'email')->ignore($this->student),
      ],
      'phone' => [
        'required', 'regex:/^62\d+$/', 'numeric',
        Rule::unique('students', 'phone')->ignore($this->student),
      ],
      'room_id' => [
        'required', 'exists:rooms,id',
      ],
      'gender' => 'required|' . GenderType::toValidation(),
      'father' => 'required|string|max:50',
      'mother' => 'required|string|max:50',
      'place_of_birth' => 'required|string|max:50',
      'date_of_birth' => 'required|date',
      'address' => 'required|string|max:50',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   */
  public function messages(): array
  {
    return [
      '*.required' => ':attribute harus tidak boleh dikosongkan',
      '*.min' => ':attribute maksimal :min karakter',
      '*.in' => ':attribute harus salah satu dari jenis berikut: :values',
      '*.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      '*.exists' => ':attribute tidak ditemukan atau tidak bisa diubah',
      '*.numeric' => ':attribute input tidak valid atau harus berupa angka',
      '*.image' => ':attribute tidak valid, pastikan memilih gambar',
      '*.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      '*.max' => ':attribute terlalu besar, maksimal :max karakter',
      '*.date' => ':attribute harus berupa tanggal',
    ];
  }

  /**
   * Get the validation attribute names that apply to the request.
   *
   * @return array<string, string>
   */
  public function attributes(): array
  {
    return [
      'name' => 'Nama',
      'room_id' => 'Kelas',
      'email' => 'Email',
      'phone' => 'No. Telepon',
      'gender' => 'Jenis Kelamin',
      'father' => 'Nama Ayah',
      'mother' => 'Nama Ibu',
      'place_of_brith' => 'Tempat Lahir',
      'date_of_brith' => 'Tanggal Lahir',
      'address' => 'Alamat',
    ];
  }
}
