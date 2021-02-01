<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanRequest extends FormRequest
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
            // 'nama_barang' => 'required|max:255',
            // 'user' => 'required|max:255',
            // 'jumlah' => 'required|integer',
            // 'kisaran' => 'required|integer',
            // 'keterangan' => 'required|max:255',
            // 'status' => 'required|max:255'
            // 'alasan' => 'required|max:255'
        ];
    }
}
