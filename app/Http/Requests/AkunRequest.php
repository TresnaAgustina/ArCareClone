<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class AkunRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9]+$/'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'email:rfc,dns'],
            'password' => ['required', 'string', 'min: 8'],
            'role' => ['required', 'in:admin,manajer,teknisi,rekanan,pelanggan'],
            'nomor_telepon' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/', 'unique:users'],
            'alamat' => ['required', 'string'],
        ];
    }
    

    // message
    public function messages(): array
    {
        return [
            'username.required' => 'Username tidak boleh kosong',
            'username.string' => 'Username harus berupa string',
            'username.max' => 'Username maksimal 255 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'username.regex' => 'Username hanya boleh berisi huruf dan angka',
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.string' => 'Email harus berupa string',
            'email.email' => 'Email harus berupa email yang valid',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'email.email:rfc, dns' => 'Email harus berupa email yang valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role tidak boleh kosong',
            'role.string' => 'Role harus berupa string',
            'role.in' => 'Role harus salah satu dari: admin, manajer, teknisi, rekanan, pelanggan',
            'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong',
            'nomor_telepon.string' => 'Nomor telepon harus berupa string',
            'nomor_telepon.max' => 'Nomor telepon maksimal 20 karakter',
            'nomor_telepon.regex' => 'Nomor telepon hanya boleh berisi angka',
            'nomor_telepon.unique' => 'Nomor telepon sudah terdaftar',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => 'Alamat harus berupa string',
        ];
        
    }
}
