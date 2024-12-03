<?php

namespace App\Http\Livewire\Poskos;

use App\Models\User;
use App\Models\Posko;
use App\Models\Bencana;
use Livewire\Component;
use App\Models\Kecamatan;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class DaftarPosko extends Component
{
    use WithFileUploads;

    public $name, $alamat_posko, $nama_posko, $nama_petugas, $no_hp, $latitude, $longitude, $jumlah_pengungsi, $status_posko, $bencana_id, $kecamatan_id, $user_id, $email, $password;

    protected $poskos, $users, $bencanas, $kecamatans;


    public function render()
    {
        return view('livewire.poskos.daftar-posko', [
            'bencanas' => Bencana::all(),
            'kecamatans' => Kecamatan::all(),
        ])->extends('livewire.poskos.form-daftar');
    }

    public function getlokasi($latitude, $longitude)
    {

        $this->emit('get-location', $latitude, $longitude);

        $this->longitude = $longitude;
        $this->latitude = $latitude;

        $this->daftar();
    }

    public function daftar()
    {
        $this->validate([
            'name' => 'required',
            'alamat_posko' => 'required',
            'nama_posko' => 'required',
            'no_hp' => 'required',
            'jumlah_pengungsi' => 'required',
            'bencana_id' => 'required',
            'kecamatan_id' => 'required',
            'email' => 'required|unique:users',
        ], [
            'name.required' => 'Nama Petugas tidak boleh kosong',
            'alamat_posko.required' => 'Alamat Posko tidak boleh kosong',
            'nama_petugas.required' => 'Nama Petugas tidak boleh kosong',
            'no_hp.required' => 'No HP tidak boleh kosong',
            'jumlah_pengungsi.required' => 'Jumlah Pengungsi tidak boleh kosong',
            'bencana_id.required' => 'Bencana tidak boleh kosong',
            'kecamatan_id.required' => 'Kecamatan tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain',
        ]);

        // dd($this->name, $this->alamat_posko, $this->nama_posko, $this->no_hp, $this->latitude, $this->longitude, $this->jumlah_pengungsi, $this->bencana_id, $this->kecamatan_id, $this->email, $this->password);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => 'kedaruratan',
            'password' => Hash::make("12345678"),
        ]);

        $userID = $user->id;

        // jika longitude dan latitude kosong gunakan default
        if ($this->longitude == null && $this->latitude == null) {
            $this->longitude = 121.6728881;
            $this->latitude = -3.9452802;
        }

        $posko = Posko::create([
            'nama_posko' => $this->nama_posko,
            'nama_petugas' => $this->name,
            'alamat_posko' => $this->alamat_posko,
            'no_hp' => $this->no_hp,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'jumlah_pengungsi' => $this->jumlah_pengungsi,
            'status_posko' => 'nonaktif',
            'bencana_id' => $this->bencana_id,
            'kecamatan_id' => $this->kecamatan_id,
            'user_id' => $userID,
        ]);

        return redirect()->route('login')->with('success', 'Berhasil mendaftar, silahkan login');
    }
}
