<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['data'] = DB::table('poli')->get();
        return view('poli.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poli.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => [
                'required', 'min:3',
            ],

        ]);

        $prodi = new Poli();
        $prodi->nama_poli = $request->nama_poli;
        $prodi->status_poli = 1;
        $prodi->save();

        return redirect()->route('poli.index')
            ->with('success', 'poli created successfully.');
    }

    public function switch_poli($id)
    {
        $ck = DB::table('poli')
            ->where('id_poli', $id)
            ->get();

        $data['status_poli'] = '1';
        if ($ck[0]->status_poli == 1) {
            $data['status_poli'] = '0';
        }

        DB::table('poli')->where('id_poli', $id)->update($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = DB::table('poli')->where('id_poli', $id)->get();
        return view('poli.edit', $data);
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
        DB::table('poli')
            ->where('id_poli', $id)
            ->update(['nama_poli' => $request->nama_poli, 'status_poli' => $request->status_poli]);

        return redirect()->route('poli.index')
            ->with('success', 'Pengajuan Pendaftaran sudah berhasil di update');
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
