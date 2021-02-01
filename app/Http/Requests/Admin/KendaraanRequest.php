<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KendaraanRequest extends FormRequest
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
            'area' => 'required|max:255',
            'model' => 'required|max:255',
            'merk' => 'required|max:255',
            'isi_silinder' => 'required|integer',
            'transmisi' => 'required|max:255',
            'no_polisi' => 'required|max:255',
            'tahun_produksi' => 'required|integer',
            'warna' => 'required|max:255',
            'no_chasis' => 'required|max:255',
            'no_engine' => 'required|max:255',
            // 'jatuh_tempo_stnk' => 'required|date',
            'waktu_pembelian' => 'required|date',
            'harga_perolehan' => 'required|integer',
            // 'nvb' => 'required|integer'
            // 'kondisi' => 'required|max:225'
        ];
    }
}
