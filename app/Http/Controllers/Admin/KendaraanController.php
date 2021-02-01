<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KendaraanRequest;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;
use DB;

class KendaraanController extends Controller
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
            $kendaraan = Kendaraan::where('kondisi', 'Baik & Berfungsi');
            $items = $kendaraan->Where('merk', 'like', '%'.$request->cari.'%')
                                ->orWhere('model', 'like', '%'.$request->cari.'%')
                                ->orWhere('no_polisi', 'like', '%'.$request->cari.'%')
                                ->orWhere('warna', 'like', '%'.$request->cari.'%')
                                ->orWhere('no_chasis', 'like', '%'.$request->cari.'%')
                                ->orWhere('no_engine', 'like', '%'.$request->cari.'%')
                                ->orderBy('jatuh_tempo_stnk')
                            ->paginate(9999);
        }else{
            $items = Kendaraan::where('kondisi', 'Baik & Berfungsi')->orderBy('jatuh_tempo_stnk')->paginate(9999);
        }

        // Waktu saat ini
        $now = \Carbon\Carbon::now();

        return view('pages.admin.kendaraan',[
            'items' => $items,
            'keyword' => $request->cari,
            'now' => $now
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
    public function store(KendaraanRequest $request)
    {
        $data = $request->all();

        Kendaraan::create($data);
        return redirect()->route('kendaraan.index');
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
    public function update(KendaraanRequest $request, $id)
    {
        $data = $request->all();

        $item = Kendaraan::findOrFail($id);

        $item->update($data);

        return redirect()->route('kendaraan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Kendaraan::findOrFail($id);
        $item->delete();

        return redirect()->route('kendaraan.index');
    }

    // Function untuk cetak laporan
    public function cetak()
    {
        $items = Kendaraan::all()->where('kondisi', 'Baik & Berfungsi');
        $judul = "Laporan Aset Kendaraan.pdf";
        $pdf = PDF::loadview('pages.admin.cetak.cetak-kendaraan', compact('items'))->setPaper('A4', 'landscape');
        return $pdf->stream($judul, array("Attachment" => false));
    }

    // function action(Request $request)
    // {
    //  if($request->ajax())
    //  {
    //   $output = '';
    //   $query = $request->get('query');
    //   if($query != '')
    //   {
    //    $data = DB::table('kendaraan')
    //      ->where('merk', 'like', '%'.$query.'%')
    //      ->orWhere('model', 'like', '%'.$query.'%')
    //      ->orWhere('no_polisi', 'like', '%'.$query.'%')
    //      ->orWhere('warna', 'like', '%'.$query.'%')
    //      ->orWhere('no_chasis', 'like', '%'.$query.'%')
    //      ->orWhere('no_engine', 'like', '%'.$query.'%')
    //      ->orderBy('id', 'desc')
    //      ->get();
         
    //   }
    //   else
    //   {
    //    $data = DB::table('kendaraan')
    //      ->orderBy('id', 'desc')
    //      ->get();
    //   }
    //   $total_row = $data->count();
    //   if($total_row > 0)
    //   {
    //    foreach($data as $row)
    //    {
    //     $output .= '
    //     <tr>
    //               <td>'.$row->area.'</td>
    //               <td>'.$row->merk.'</td>
    //               <td>'.$row->model.'</td>
    //               <td>'.$row->no_polisi.'</td>
    //               <td>'.$row->warna.'</td>
    //               <td>
    //                 <i class="fa fa-circle text-success"></i>
    //                 '.$row->jatuh_tempo_stnk.'
    //               <td style="width: 130px !important;">
    //                 <div class="text-center">
    //                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal-{{ $item->id }}">
    //                     <i class="fa fa-eye"></i>
    //                   </button>
    //                   <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
    //                     <i class="fa fa-pencil-alt"></i>
    //                   </button>
    //                     <button class="btn btn-danger btn-sm">
    //                       <i class="fa fa-trash"></i>
    //                     </button>
    //                   </form>
    //                 </div>
    //               </td>
    //             </tr>
    //     </tr>
    //     ';
    //    }
    //   }
    //   else
    //   {
    //    $output = '
    //    <tr>
    //     <td align="center" colspan="5">No Data Found</td>
    //    </tr>
    //    ';
    //   }
    //   $data = array(
    //    'table_data'  => $output,
    //    'total_data'  => $total_row
    //   );

    //   echo json_encode($data);
    //  }
    // }
}
