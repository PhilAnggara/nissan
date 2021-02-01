<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KendaraanRequest;
use App\Http\Requests\Admin\PeralatanRequest;
use App\Http\Requests\Admin\KantorRequest;
use App\Models\Kendaraan;
use App\Models\Peralatan;
use App\Models\Kantor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RusakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraan = Kendaraan::all()->where('kondisi', 'Rusak');
        $peralatan = Peralatan::all()->where('kondisi', 'Rusak');
        $kantor = Kantor::all()->where('kondisi', 'Rusak');

        return view('pages.admin.aset-rusak',[
            'kendaraan' => $kendaraan,
            'peralatan' => $peralatan,
            'kantor' => $kantor
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
        return redirect()->route('aset-rusak.index');
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

        return redirect()->route('aset-rusak.index');
    }

    public function updateKendaraan(KendaraanRequest $request, $id)
    {
        $data = $request->all();

        $item = Kendaraan::findOrFail($id);

        $item->update($data);

        return redirect()->route('aset-rusak.index');
    }
    
    public function updatePeralatan(PeralatanRequest $request, $id)
    {
        $data = $request->all();

        $item = Peralatan::findOrFail($id);

        $item->update($data);

        return redirect()->route('aset-rusak.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyKendaraan($id)
    {
        $item = Kendaraan::findOrFail($id);
        $item->delete();

        return redirect()->route('aset-rusak.index');
    }
    public function destroyPeralatan($id)
    {
        $item = Peralatan::findOrFail($id);
        $item->delete();

        return redirect()->route('aset-rusak.index');
    }
    public function destroy($id)
    {
        $item = Kantor::findOrFail($id);
        $item->delete();

        return redirect()->route('aset-rusak.index');
    }
}
