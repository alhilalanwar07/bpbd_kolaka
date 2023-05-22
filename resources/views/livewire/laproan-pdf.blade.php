<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendistribusian Bantuan Logistik {{ $data->nama_posko }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">


    <style>
        @page {
            margin-top: 30px;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 30px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif, Helvetica, Arial, sans-serif;
        }

        table.bordered {
            border-collapse: collapse;
        }

        table.bordered thead,
        table.bordered body,
        table.bordered tr,
        table.bordered td,
        table.bordered th {
            /* border: 1px solid black; */
            border-top: solid 1px black;
            border-left: solid 1px black;
            border-right: solid 1px black;
            border-bottom: solid 1px black;
        }

        th,
        td {
            padding: 5px;
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-0.5 * var(--bs-gutter-x));
            margin-left: calc(-0.5 * var(--bs-gutter-x));
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-top: var(--bs-gutter-y);
        }

        .col {
            flex: 1 0 0%;
        }

        .text-center {
            text-align: center;
        }

        .check {
            width: 20px;
            height: 20px;
            display: inline-block;
            position: relative;
        }

        .check:before {
            content: "";
            position: absolute;
            top: 4px;
            left: 6px;
            width: 4px;
            height: 10px;
            border-bottom: 2px solid black;
            border-right: 2px solid black;
            transform: rotate(45deg);
        }
    </style>
</head>

<body>
    <div style="margin-left:50px;margin-right:30px">
        <table style="border-bottom: solid 1px black">
            <th style="vertical-align: middle">
                <img src="data:image/png;base64,{{ $image }}" alt="logo usn" style="width: 100px">
            </th>
            <th>
                <h2 style="margin-top:5px;margin-bottom:5px">PEMERINTAH KABUPATEN KOLAKA TIMUR</h2>
                <h2 style="margin-top:5px;margin-bottom:5px">BADAN PENANGGULANGAN BENCANA DAERAH</h2>
                <h3 style="margin-top:3px;margin-bottom:5px;font-size:12px;font-weight:normal;">KOMPLEKS PERKANTORAN
                    PEMDA KAB. KOLAKA TIMUR</h3>
                <p style="margin-top:3px;margin-bottom:5px;font-size:12px;font-weight:normal;"> email : bpbdkoltim@gmail.com</p>
            </th>
            <th style="vertical-align: middle">
                <img src="data:image/png;base64,{{ $image1 }}" alt="logo usn" style="width: 100px">
            </th>
        </table>
        <table style="width: 100%;text-align:center">
            <h5 style="margin-top:5px;margin-bottom:5px">PENDISTIBUSIAN BANTUAN LOGISTIK</h5>
            <h5 style="margin-top:5px;margin-bottom:5px;font-weight:normal;">NOMOR:<span style="margin-right: 50px">
                </span>/<span style="margin-right: 50px"> </span>/</h5>
        </table>
        <br>
        <table style="width: 100%; margin-top:5px;font-size:13px">
            <tr>
                <td>Alamat</td>
                <td colspan="3">: {{ ucwords($data->alamat_posko) }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td colspan="3">: {{ ucwords($data->nama_kecamatan) }}</td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td colspan="3">: KOLAKA TIMUR</td>
            </tr>
        </table>

        <table class="bordered" style="width: 100%; margin-top:5px;font-size:13px">
            <thead>
                <tr style="text-align: center; font-weight:bold">
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Jenis Logistik</th>
                    <th style="text-align: center">Jumlah</th>
                    <th style="text-align: center">Satuan</th>
                    <th style="text-align: center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kebutuhan_poskos as $item)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: center">{{ strtoupper($item->nama_barang) }}</td>
                    <td style="text-align: center">{{ $item->jumlah_kebutuhan }}</td>
                    <td style="text-align: center">{{ $item->nama_satuan }}</td>
                    <td style="text-align: center"></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table style="width: 100%; margin-top:15px;font-size:13px;page-break-inside: avoid;">
            <tr>
                <td></td>
                <td style="text-align: center">{{ ucwords($data->nama_kecamatan) }},<span style="margin-right: 50px">
                    </span><span
                        style="margin-right: 50px"> </span> 2023</td>
            </tr>
            <tr>
                <td style="text-align: center">
                    Yang Menyerahkan
                    <br><br>
                    <p></p>
                    <br><br>
                    <b> {{ $namaPenerima}}</b>
                </td>
                <td style="text-align: center">
                    Yang Menyerahkan
                    <br><br>
                    <img src="data:image/png;base64,{!! $qrPetugas !!}" alt="qrcode" style="width: 40px">

                    <br><br>
                    <b> {{ $data->nama_petugas }}</b>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
