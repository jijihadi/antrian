<?php

namespace App\Http\Controllers;

use App\Mail\AntrianNotifMail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data['antrian'] = DB::table('nomor_antrian')
            ->join('poli', 'poli.id_poli', '=', 'nomor_antrian.id_poli')
            ->join('users', 'users.id', '=', 'nomor_antrian.id_pasien')
            ->get();
        $data['poli'] = DB::table('poli')->get();

        // dd( $data[ 'antrian' ] );
        return view('antrian.index', $data);
    }

    public function list_antrian()
    {

        $data['riwayat'] = DB::table('nomor_antrian')
            ->join('poli', 'poli.id_poli', '=', 'nomor_antrian.id_poli')
            ->get();

        // dd( $data[ 'antrian' ] );
        return view('antrian.list', $data);
    }

    public function report_poli()
    {

        $data['poli'] = DB::table('poli')
            ->get();

        // dd( $data[ 'antrian' ] );
        return view('antrian.report_poli', $data);
    }

    function print($id) {

        $data['antrian'] = DB::table('nomor_antrian as a')
            ->select('a.*', 'b.id', 'b.name', 'c.id_poli', 'c.nama_poli')
            ->leftJoin('users as b', 'a.id_pasien', 'b.id')
            ->leftJoin('poli as c', 'a.id_poli', 'c.id_poli')
            ->where('a.nomor_antrian', $id)
            ->get();

        // return view('antrian.cetak', $data);
        $pdf = PDF::loadView('antrian.cetak', $data);

        $pdf->setPaper('A6', 'landscape');
// Render the HTML as PDF
        $pdf->render();
// Output the generated PDF to Browser
        $pdf->stream();
        return $pdf->stream($data['antrian'][0]->nomor_antrian."-".date('dMY').'.pdf', array("Attachment" => false));
        return $pdf->download($data['antrian'][0]->nomor_antrian.'.pdf');

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
        // $urutan = DB::table( 'nomor_antrian' )->where( 'nomor_antrian', 'like', '%'.$request->name.'%' )->get();
    }

    public function record_antrian(Request $request)
    {
        $id_antrian = $request->id_antrian;
        $id_poli = $request->id_poli;

        $data = [
            'id_poli' => $id_poli,
            'id_antrian' => $id_antrian,
        ];
        $data1 = [
            'status_antrian' => 2,
        ];
        if ($id_antrian > 0) {
            // dd($id_antrian);
            $id3 = (int) $id_antrian;
            $id3 = $id3 - 1;
            $data3 = ['status_antrian' => 3];
            DB::table('nomor_antrian')
                ->where('id_antrian', $id3)
                ->update($data3);
        }
        DB::table('record_antrian')->insert($data);
        DB::table('nomor_antrian')
            ->where('id_antrian', $id_antrian)
            ->update($data1);
    }

    public function finish(Request $request)
    {
        $id_antrian = $request->id_antrian;
        $id_poli = $request->id_poli;
        $id2 = $id_antrian;

        $data2 = ['status_antrian' => 3];
        DB::table('nomor_antrian')
            ->where('id_antrian', $id2)
            ->update($data2);
    }

    public function daftar_antrian(Request $request)
    {
        $id_pasien = auth()->user()->id;
        $id_poli = $request->id;
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_sekarang = date('Y-m-d');
        $urutan = DB::table('nomor_antrian')
            ->where('id_poli', $id_poli)
            ->where('created_at', 'like', '%' . $tanggal_sekarang . '%')
            ->orderBy('nomor_antrian', 'desc')
            ->limit(1)
            ->get();

        if (empty($urutan[0]->nomor_antrian)) {
            $nomor_antrian = autonumber($request->nama_poli . sprintf('%03s', 0), 3, 3);
        } else {
            $nomor_antrian = autonumber($urutan[0]->nomor_antrian, 3, 3);
        }

        $urutan = DB::table('poli')->where('id_poli', $request->id);
        $urutan++;

        $data = [
            'id_poli' => $id_poli,
            'nomor_antrian' => $nomor_antrian,
            'status_antrian' => 1,
            'id_pasien' => $id_pasien,
        ];
        DB::table('nomor_antrian')->insert($data);

        $numb = substr($nomor_antrian, -3);
        $numb = (int) $numb;

        // if ($numb>0) {
        //     $kode_nomor = substr($nomor_antrian, 0, -3);
        //     $old_numb = $numb -1;
        //     $old_numb = substr("000{$old_numb}", -3);
        //     $old_nomor = $kode_nomor.$old_numb;

        //     $data = [
        //         'id_poli' => $id_poli,
        //         'nomor_antrian' => $old_nomor,
        //         'status_antrian' => 3,
        //         'id_pasien' => $id_pasien
        //     ];
        //     DB::table( 'nomor_antrian' )->insert( $data );
        // }

        Mail::to(auth()->user()->email)->send(new AntrianNotifMail());

        if (Mail::failures()) {
            dd(Mail::failures());
        }

        return redirect()
            ->route('pasien.index')
            ->with('success', 'pengajuan nomor antrian berhasil di kirim');
        // DB::table( 'users' )->where( 'id', $id_pasien );
    }

    public function mail()
    {
        $tanggal_sekarang = date('Y-m-d');
        $urutan = DB::table('nomor_antrian')
            ->where('id_pasien', auth()->user()->id)
            ->where('created_at', 'like', '%' . $tanggal_sekarang . '%')
            ->orderBy('nomor_antrian', 'desc')
            ->limit(1)
            ->get();

        $nama_poli = DB::table('poli')
            ->where('id_poli', $urutan[0]->id_poli)
            ->get();
        // dd( $nama_poli );

        return $this->from('admin@puskesmasklatak.com')
            ->view('notifemail')
            ->with([
                'nama' => Auth::user()->name,
                'antrian' => $urutan[0]->nomor_antrian,
                'poli' => $nama_poli[0]->nama_poli,
                'waktu' => tgl_indo(date('Y-m-d')),
            ]);
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
