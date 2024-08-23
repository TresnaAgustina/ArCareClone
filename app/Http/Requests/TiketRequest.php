<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiketRequest extends FormRequest
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
            'id_pelanggan' => ['required', 'integer', 'exists:users,id'],
            'nama_pic_fakultas' => ['required', 'string', 'max:255'],
            'telepon_pic_fakultas' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/', 'min:10'],
            'nama_pic_ruangan' => ['required', 'string', 'max:255'],
            'telepon_pic_ruangan' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/', 'min:10'],
            'keterangan' => ['nullable', 'string'],
            'detail_tickets.*.lokasi' => ['required', 'string', 'max:255'],
            'detail_tickets.*.alamat' => ['required', 'string', 'max:255'],
            'detail_tickets.*.detail_products.*.merk_produk' => ['required', 'string', 'max:255'],
            'detail_tickets.*.detail_products.*.permasalahan' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id_pelanggan.required' => 'ID/Nama Pelanggan wajib diisi',
            'id_pelanggan.integer' => 'ID Pelanggan harus berupa angka',
            'id_pelanggan.exists' => 'ID Pelanggan tidak ditemukan',
            'nama_pic_fakultas.required' => 'Nama PIC Fakultas wajib diisi',
            'nama_pic_fakultas.string' => 'Nama PIC Fakultas harus berupa string',
            'nama_pic_fakultas.max' => 'Nama PIC Fakultas maksimal 255 karakter',
            'telepon_pic_fakultas.required' => 'Telepon PIC Fakultas wajib diisi',
            'telepon_pic_fakultas.string' => 'Telepon PIC Fakultas harus berupa string',
            'telepon_pic_fakultas.max' => 'Telepon PIC Fakultas maksimal 20 karakter',
            'telepon_pic_fakultas.regex' => 'Telepon PIC Fakultas harus berupa angka',
            'telepon_pic_fakultas.min' => 'Telepon PIC Fakultas minimal 10 karakter',
            'nama_pic_ruangan.required' => 'Nama PIC Ruangan wajib diisi',
            'nama_pic_ruangan.string' => 'Nama PIC Ruangan harus berupa string',
            'nama_pic_ruangan.max' => 'Nama PIC Ruangan maksimal 255 karakter',
            'telepon_pic_ruangan.required' => 'Telepon PIC Ruangan wajib diisi',
            'telepon_pic_ruangan.string' => 'Telepon PIC Ruangan harus berupa string',
            'telepon_pic_ruangan.max' => 'Telepon PIC Ruangan maksimal 20 karakter',
            'telepon_pic_ruangan.regex' => 'Telepon PIC Ruangan harus berupa angka',
            'telepon_pic_ruangan.min' => 'Telepon PIC Ruangan minimal 10 karakter',
            'keterangan.string' => 'Keterangan harus berupa string',
            'detail_tickets.*.lokasi.required' => 'Lokasi wajib diisi',
            'detail_tickets.*.lokasi.string' => 'Lokasi harus berupa string',
            'detail_tickets.*.lokasi.max' => 'Lokasi maksimal 255 karakter',
            'detail_tickets.*.alamat.required' => 'Alamat wajib diisi',
            'detail_tickets.*.alamat.string' => 'Alamat harus berupa string',
            'detail_tickets.*.alamat.max' => 'Alamat maksimal 255 karakter',
            'detail_tickets.*.detail_products.*.merk_produk.required' => 'Merk Product wajib diisi',
            'detail_tickets.*.detail_products.*.merk_produk.string' => 'Merk Product harus berupa string',
            'detail_tickets.*.detail_products.*.merk_produk.max' => 'Merk Product maksimal 255 karakter',
            'detail_tickets.*.detail_products.*.permasalahan.required' => 'Permasalahan wajib diisi',
            'detail_tickets.*.detail_products.*.permasalahan.string' => 'Permasalahan harus berupa string',
            'detail_tickets.*.detail_products.*.permasalahan.max' => 'Permasalahan maksimal 255 karakter',
        ];
    }
}
