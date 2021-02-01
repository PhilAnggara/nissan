<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PeralatanRequest;
use App\Models\Peralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;
use DB;

class PeralatanController extends Controller
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
            $peralatan = Peralatan::where('kondisi', 'Baik & Berfungsi');
            $items = $peralatan->Where('jenis_aset', 'like', '%'.$request->cari.'%')
                                ->orWhere('tahun_perolehan', 'like', '%'.$request->cari.'%')
                                ->orWhere('user', 'like', '%'.$request->cari.'%')
                            ->paginate(9999);
        }else{
            $items = Peralatan::where('kondisi', 'Baik & Berfungsi')->paginate(9999);
        }

        return view('pages.admin.peralatan',[
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
    public function store(PeralatanRequest $request)
    {
        $data = $request->all();

        Peralatan::create($data);
        return redirect()->route('peralatan.index');
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
    public function update(PeralatanRequest $request, $id)
    {
        $data = $request->all();

        $item = Peralatan::findOrFail($id);

        $item->update($data);

        return redirect()->route('peralatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Peralatan::findOrFail($id);
        $item->delete();

        return redirect()->route('peralatan.index');
    }

    // Function untuk cetak laporan
    public function cetak()
    {
        $items = Peralatan::all()->where('kondisi', 'Baik & Berfungsi');
        $judul = "Laporan Aset Peralatan Bengkel.pdf";
        $pdf = PDF::loadview('pages.admin.cetak.cetak-peralatan', compact('items'))->setPaper('A4', 'portrait');
        return $pdf->stream($judul, array("Attachment" => false));
    }
}
