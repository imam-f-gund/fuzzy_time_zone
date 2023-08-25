<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

use App\Metode\fuzzy;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Pendapatan::all();

        return view('pendapatan', compact('data'));

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
        //
            $validator = Validator::make($request->all(), [ 
                'bulan' => 'required',
                'tahun' => 'required',
                'pendapatan' => 'required',
            ]);

            if ($validator->fails()) {
          
                Alert::error('Gagal', 'Data Gagal Ditambahkan'.$validator->errors());
                return back();
            }    

            $cek = Pendapatan::where('bulan', $request->bulan)->where('tahun', $request->tahun)->first();

            if($cek){
                Alert::error('Gagal', 'Data Gagal Ditambahkan, Data Sudah Ada');
                return back();
            }

            Pendapatan::create($request->all());

            Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
            return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendapatan  $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function show(Pendapatan $pendapatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendapatan  $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendapatan $pendapatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendapatan  $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $validator = Validator::make($request->all(), [ 
            'bulan' => 'required',
            'tahun' => 'required',
            'pendapatan' => 'required',
        ]);

        if ($validator->fails()) {
      
            Alert::error('Gagal', 'Data Gagal Diubah'.$validator->errors());
            return back();
        }    

        $pendapatan=Pendapatan::find($id);
        $pendapatan->update($request->all());

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendapatan  $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Pendapatan::destroy($id);

        Alert::success('Berhasil', 'Data Berhasil Didapus');
        return back();
    }

    public function cek_pendapatan(){
        $fuzzy = new fuzzy;
        $data = Pendapatan::all();

        $hasil = $fuzzy->nilaiPrediksi($data);
        
        return view('cekpendapatan', compact('hasil'));
    }
}
