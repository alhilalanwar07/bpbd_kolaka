<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Posko;
use Livewire\Component;
use App\Models\KebutuhanPosko;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Laporan extends Component
{
    public $tanggal_permintaan,
        $posko_id,
        $nama_petugas,
        $nama_barang,
        $jumlah,
        $satuan,
        $keterangan,
        $tanggal_pengiriman,
        $status, $nama_penerima, $qrPetugas;

    protected $barangs,
        $poskos,
        $satuans,
        $kecamatans,
        $bencanas,
        $logistiks,
        $stoks,
        $kebutuhan_poskos,
        $users;

    public function render()
    {
        return view('livewire.laporan', [
            'poskos' => Posko::all(),
        ])->extends('layouts.app')->section('content');
    }

    public function cetak()
    {
        date_default_timezone_set('Asia/Makassar');

        // $image = base64_encode(file_get_contents(url('/assets/img/logokoltim.png')));
        // $image1 = base64_encode(file_get_contents(url('/assets/img/bpbd.png')));

        $data = Posko::join('bencanas', 'poskos.bencana_id', '=', 'bencanas.id')
            ->join('kecamatans', 'poskos.kecamatan_id', '=', 'kecamatans.id')
            ->join('users', 'poskos.user_id', '=', 'users.id')
            ->select('poskos.*', 'bencanas.nama_bencana', 'kecamatans.nama_kecamatan', 'users.name')
            ->where('poskos.id', '=', $this->posko_id)
            ->first();

        $kebutuhan_poskos = KebutuhanPosko::join('barangs', 'kebutuhan_poskos.barang_id', '=', 'barangs.id')
            ->join('satuans', 'kebutuhan_poskos.satuan_id', '=', 'satuans.id')
            ->select('kebutuhan_poskos.*', 'barangs.nama_barang', 'satuans.nama_satuan')
            ->where('kebutuhan_poskos.posko_id', '=', $this->posko_id)
            ->where('kebutuhan_poskos.status_kebutuhan', '=', 'terdistribusi')
            ->whereDate('kebutuhan_poskos.created_at', '=', $this->tanggal_permintaan)
            ->get();
        //menghitung masa kerja keseluruhan per hari ini
        $tglNow = Carbon::now();

        $namaPenerima = $this->nama_penerima;

        $logokoltim = url('/assets/img/logokoltim.png');
        $bpbd = url('/assets/img/bpbd.png');

        // encode logokoltim dan bpbd
        // $logokoltim = base64_encode(file_get_contents(url('/assets/img/logokoltim.png')));
        // $bpbd = base64_encode(file_get_contents(url('/assets/img/bpbd.png')));

        // dd($data, $kebutuhan_poskos, $tglNow, $url, $namaPenerima);

        $qrPetugas = 'Nama Posko:' . $data->nama_posko . ' | ' . 'Nama Petugas:' . $this->nama_petugas . ' | ' . 'Nama Penerima:' . $this->nama_penerima . ' | ' . 'Tanggal Permintaan:' . $this->tanggal_permintaan;

        $pdf = \Pdf::loadView('livewire.laproan-pdf', compact('data', 'kebutuhan_poskos', 'tglNow', 'qrPetugas', 'namaPenerima','bpbd', 'logokoltim'))->setOptions(['defaultFont' => 'sans-serif'])->output();
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, Carbon::now()->format('Y-m-d') . '-Laporan-Posko-' . $data->nama_posko . '.pdf'
        );
    }
}
