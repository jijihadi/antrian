<!DOCTYPE html>
<html>

<head>
    <title>Tiket {{ $antrian[0]->nomor_antrian }}</title>
</head>
{{-- {{dd($antrian)}} --}}

<body>
    <header>
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            table {
                /* width: 100%; */
                border: 1px solid black;
                border-collapse: collapse;
                padding: 1em;
                font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;            
            }

            .no-border {
                border: none;
            }

            .text-center {
                text-align: center;
            }

            .text-info {
                font-style: italic;
                color: lightgray;
                font-size: 92%;
            }

            .fst-bold {
                font-weight: 800;
            }

            .fst-italic {
                font-style: italic;
            }

            .box {
                border: 1px solid black;
                border-style: double;
            }

            .m-2 {
                margin-top: 2em;
            }

            .mv-1 {
                margin-top: .3em;
                margin-bottom: .3em;
            }

            .m-2 {
                margin: 1em;
            }

            .m-4 {
                margin-top: 4em;
            }

            .pv-1 {
                padding-top: .4em;
                padding-bottom: .3em;
            }

            .pv-2 {
                padding-top: 2em;
                padding-bottom: 2em;
            }

            .pl-2 {
                padding-left: 2em;
                /* padding-right: 2em; */
            }

            .pr-2 {
                padding-right: 2em;
                /* padding-right: 2em; */
            }
        </style>
    </header>
    <table class="tb">
        <tr>
            <td colspan="3" class="text-center">
                <H2 class="pv-1"><b>PUSKESMAS KLATAK</b></H2>
                <p>Jl. Yos Sudarso No. 179, Banyuwangi <br> Jawa Timur 68421, Indonesia</p>
                <p>(+62 333 425290) <br><br></p>
                <hr>
            </td>
        </tr>
        @foreach ($antrian as $row)
            <tr>
                <td class="fst-bold pl-2">
                    <p class="mv-1">Nama</p>
                </td>
                <td class="fst-bold" width="5%">:</td>
                <td>{{ $row->name }}</td>
            </tr>
            <tr>
                <td colspan="3" class="box">
                </td>
            </tr>
            <tr>
                <td class="fst-bold pl-2">
                    <p class="mv-1">Poli Tujuan</p>
                </td>
                <td class="fst-bold">:</td>
                <td>{{ $row->nama_poli }}</td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="pr-2">
                    <div class="box m-2 pv-1">
                        <h4 class="text-center"> <small>Nomor Antrian</small></h4>
                        <h1 class="text-center">{{ $row->nomor_antrian }}</h1>
                        <p class="text-center fst-italic"><small>{{ tgl_indo($row->created_at) }}</small></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p class="text-info text-center m-2">
                        Silahkan simpan dan tunjukkan tiket ini kepada petugas di loket pendaftaran
                    </p>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
