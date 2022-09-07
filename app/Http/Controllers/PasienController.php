<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $data['pasien'] = DB::table('users')->where('role',3)->get();
        $data['antrian'] = DB::table('nomor_antrian')->where('created_at','like','%'.$tanggal.'%')->get();
        
        if(auth()->user()->role == 3){
            $id_pasien = auth()->user()->id;
            $data['mypasien'] = DB::table('nomor_antrian')->where('id_pasien',$id_pasien)
                                                           ->where('created_at','like','%'.$tanggal.'%')
                                                          ->get();
            // dd($data['mypasien']);
        }
      
        return view('pasien.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        // $data['pasien'] = 
        return view('pasien.edit');
    }

    public function verifikasi($id)
    {

        $data['antrian'] = DB::table('nomor_antrian')
                            ->join('users', 'users.id', '=', 'nomor_antrian.id_pasien')
                            ->where('nomor_antrian.id_antrian',$id)
                            ->get();
        return view('pasien.verifikasi',$data);

    }
    public function verifikasi_update(Request $request,$id)
    {

        $status = $request->status_antrian;

        DB::table('nomor_antrian')->where('id_antrian',$id)
            ->update(['status_antrian'=>$status]);

        return redirect()->route('pasien.index');


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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
