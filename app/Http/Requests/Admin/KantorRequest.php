<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KantorRequest extends FormRequest
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
            'nama_pt' => 'required|max:255',
            'nama_cabang' => 'required|max:255',
            'nama_aset' => 'required|max:255',
            'nomor_aset' => 'required|max:225',
            // 'kondisi' => 'required|max:225',
            'informasi' => 'required|max:225',
            // 'tahun_perolehan' => 'required|integer',
            // 'nilai_perolehan' => 'required|integer',
            'user' => 'required|max:255'
        ];
    }
}
