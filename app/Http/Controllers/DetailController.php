<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendapatan;
use App\Models\DetailPendapatan;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
       
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
    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'ukuran' => 'required',
            'warna' => 'required',
            'penjualan' => 'required',
            'jenis_kaos' => 'required',
            'pendapatan' => 'required|nullable',
        ]);

        if ($validator->fails()) {

            Alert::error('Gagal', 'Data Gagal Ditambahkan' . $validator->errors());
            return back();
        }

        DetailPendapatan::create($request->all());

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return back();

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
        $data = DetailPendapatan::where('pendapatan_id', $id)->get();
        $pendapatan = Pendapatan::where('id',$id)->first();
       
        return view('detailpendapatan',compact('data','pendapatan'));
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
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'ukuran' => 'required',
            'warna' => 'required',
            'penjualan' => 'required',
            'jenis_kaos' => 'required',
            'pendapatan' => 'required|nullable',
           
        ]);

        if ($validator->fails()) {

            Alert::error('Gagal', 'Data Gagal Ditambahkan' . $validator->errors());
            return back();
        }

        $detailpendapatan = DetailPendapatan::find($id);
        $detailpendapatan->update($request->all());

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DetailPendapatan::destroy($id);

        Alert::success('Berhasil', 'Data Berhasil Didapus');
        return back();
    }
}
