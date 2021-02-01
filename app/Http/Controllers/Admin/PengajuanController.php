<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PengajuanRequest;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;
use DB;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $items = Pengajuan::all()->where('status', 'Diproses');
    //     $things = Pengajuan::all()->where('status', 'Disetujui');

    //     return view('pages.admin.pengajuan',[
    //         'items' => $items,
    //         'things' => $things
    //     ]);
    // }
    public function index(Request $request)
    {
        // Function untuk pencarian data
        if($request->has('cari')){
            $pengajuan = Pengajuan::Where('nama_barang', 'like', '%'.$request->cari.'%')
                                ->orWhere('user', 'like', '%'.$request->cari.'%')
                                ->orWhere('keterangan', 'like', '%'.$request->cari.'%')
                            ->get();
            $items = $pengajuan->where('status', 'Diproses');
            $things = $pengajuan->where('status', 'Disetujui');
            $rejects = $pengajuan->where('status', 'Ditolak');
        }else{
            $items = Pengajuan::all()->where('status', 'Diproses');
            $things = Pengajuan::all()->where('status', 'Disetujui');
            $rejects = Pengajuan::all()->where('status', 'Ditolak');
        }

        return view('pages.admin.pengajuan',[
            'items' => $items,
            'things' => $things,
            'rejects' => $rejects,
            'keyword' => $request->cari
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengajuanRequest $request)
    {
        $data = $request->all();

        Pengajuan::create($data);
        return redirect()->route('pengajuan-aset.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PengajuanRequest $request, $id)
    {
        $data = $request->all();

        $item = Pengajuan::findOrFail($id);

        $item->update($data);

        return redirect()->route('pengajuan-aset.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pengajuan::findOrFail($id);
        $item->delete();

        return redirect()->route('pengajuan-aset.index');
    }

    // Function untuk cetak laporan
    public function cetak()
    {
        $items = Pengajuan::all()->where('status', 'Diproses');
        $things = Pengajuan::all()->where('status', 'Disetujui');
        $judul = "Laporan Permintaan Aset.pdf";
        $pdf = PDF::loadview('pages.admin.cetak.cetak-pengajuan-aset', compact('items','things'))->setPaper('A4', 'portrait');
        return $pdf->stream($judul, array("Attachment" => false));
    }
}
