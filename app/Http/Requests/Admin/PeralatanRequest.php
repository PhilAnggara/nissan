<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PeralatanRequest extends FormRequest
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
            'nama_cabang' => 'required|max:255',
            'nama_pt' => 'required|max:255',
            'area' => 'required|max:255',
            'jenis_aset' => 'required|max:225',
            // 'tahun_perolehan' => 'required|integer',
            // 'nilai_perolehan' => 'required|integer',
            // 'nilai_buku' => 'required|integer',
            'user' => 'required|max:255',
            'status' => 'required|max:255'
            // 'kondisi' => 'required|max:225',
        ];
    }
}
