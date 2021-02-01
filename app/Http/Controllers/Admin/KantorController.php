<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KantorRequest;
use App\Models\Kantor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;
use DB;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Function untuk pencarian data
        if($request->has('cari')){
            $kantor = Kantor::where('kondisi', 'Baik & Berfungsi');
            $items = $kantor->Where('nama_aset', 'like', '%'.$request->cari.'%')
                                ->orWhere('nomor_aset', 'like', '%'.$request->cari.'%')
                                ->orWhere('informasi', 'like', '%'.$request->cari.'%')
                                ->orWhere('tahun_perolehan', 'like', '%'.$request->cari.'%')
                                ->orWhere('user', 'like', '%'.$request->cari.'%')
                            ->paginate(9999);
        }else{
            $items = Kantor::where('kondisi', 'Baik & Berfungsi')->paginate(9999);
        }

        return view('pages.admin.kantor',[
            'items' => $items,
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
    public function store(KantorRequest $request)
    {
        $data = $request->all();

        Kantor::create($data);
        return redirect()->route('kantor.index');
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
    public function update(KantorRequest $request, $id)
    {
        $data = $request->all();

        $item = Kantor::findOrFail($id);

        $item->update($data);

        return redirect()->route('kantor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Kantor::findOrFail($id);
        $item->delete();

        return redirect()->route('kantor.index');
    }

    // Function untuk cetak laporan
    public function cetak()
    {
        $items = Kantor::all()->where('kondisi', 'Baik & Berfungsi');
        $judul = "Laporan Aset Peralatan Kantor.pdf";
        $pdf = PDF::loadview('pages.admin.cetak.cetak-kantor', compact('items'))->setPaper('A4', 'portrait');
        return $pdf->stream($judul, array("Attachment" => false));
    }
}
