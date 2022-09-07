<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Auth;

class AntrianNotifMail extends Mailable {
    use Queueable, SerializesModels;

    /**
    * Create a new message instance.
    *
    * @return void
    */

    public function __construct() {
        //
    }

    /**
    * Build the message.
    *
    * @return $this
    */

    public function build() {


        $tanggal_sekarang = date( 'Y-m-d' );
        $urutan = DB::table( 'nomor_antrian' )
        ->where( 'id_pasien', Auth::user()->id )
        ->where( 'created_at', 'like', '%'.$tanggal_sekarang.'%' )
        ->orderBy( 'nomor_antrian', 'desc' )
        ->limit( 1 )
        ->get();


       

        $nama_poli = DB::table( 'poli' )->where( 'id_poli', $urutan[0]->id_poli )->get();
        // dd( $nama_poli );

        return $this->from( 'diptamuslim90@gmail.com' )
        ->view( 'notifemail' )
        ->with(
            [
                'nama' => Auth::user()->name,
                'antrian' => $urutan[ 0 ]->nomor_antrian,
                'poli' => $nama_poli[ 0 ]->nama_poli,
                'waktu' => tgl_indo( date( 'Y-m-d' ) ),
            ] );
        }
    }
