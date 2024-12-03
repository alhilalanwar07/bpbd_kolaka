<?php

namespace App\Http\Livewire;

use App\Models\Posko;
use App\Models\Barang;
use App\Models\Logistik;
use App\Models\Satuan;
use App\Models\Bencana;
use App\Models\Kecamatan;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\KebutuhanPosko;

class Poskos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nama_posko, $nama_petugas, $alamat_posko, $no_hp, $latitude, $longitude, $jumlah_pengungsi, $status_posko, $bencana_id, $kecamatan_id, $user_id, $barang_id, $quantity, $satuan_id, $keterangan;

    public $rows = [], $barangs;

    protected $rules = [
        'rows.*.barang_id' => 'required',
        'rows.*.quantity' => 'required',
        'rows.*.satuan_id' => 'required',
    ], $messages = [
        'rows.*.barang_id.required' => 'Barang tidak boleh kosong.',
        'rows.*.quantity.required' => 'Quantity tidak boleh kosong.',
        'rows.*.satuan_id.required' => 'Satuan tidak boleh kosong.',
    ];

    public function mount()
    {
        $barangs = Barang::where('stok', '>', '0')->orderBy('created_at', 'DESC')->get();
        $satuans = Satuan::all();
        $this->barangs = $barangs;
        $this->satuans = $satuans;
        if($this->selected_id != null){
            // verifikasi jumlah_barang di tabel logistik dengan row.*.quantity. jika jumlah_barang < row.*.quantity, maka message error
            $posko = Posko::findOrFail($this->selected_id);
            $kebutuhanPosko = KebutuhanPosko::where('posko_id', $this->selected_id)->get();
            $this->rows = $kebutuhanPosko->toArray();
            // nanti dilanjutkan, saya istirahat dulu
        }
    }

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.poskos.view', [
            'poskos' => Posko::join('kecamatans', 'kecamatans.id', '=', 'poskos.kecamatan_id')
                        ->join('bencanas', 'bencanas.id', '=', 'poskos.bencana_id')
                        ->join('users', 'users.id', '=', 'poskos.user_id')
                        ->select('poskos.*', 'kecamatans.nama_kecamatan', 'bencanas.nama_bencana', 'users.name')
                        ->latest()
						->orWhere('nama_posko', 'LIKE', $keyWord)
						->orWhere('nama_petugas', 'LIKE', $keyWord)
						->orWhere('alamat_posko', 'LIKE', $keyWord)
						->orWhere('no_hp', 'LIKE', $keyWord)
						->orWhere('latitude', 'LIKE', $keyWord)
						->orWhere('longitude', 'LIKE', $keyWord)
						->orWhere('jumlah_pengungsi', 'LIKE', $keyWord)
						->orWhere('status_posko', 'LIKE', $keyWord)
						->orWhere('bencana_id', 'LIKE', $keyWord)
						->orWhere('kecamatan_id', 'LIKE', $keyWord)
						->orWhere('user_id', 'LIKE', $keyWord)
						->paginate(10),
            'bencanas' => Bencana::all(),
            'kecamatans' => Kecamatan::all(),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
		$this->nama_posko = null;
		$this->nama_petugas = null;
		$this->alamat_posko = null;
		$this->no_hp = null;
		$this->latitude = null;
		$this->longitude = null;
		$this->jumlah_pengungsi = null;
		$this->status_posko = null;
		$this->bencana_id = null;
		$this->kecamatan_id = null;
		$this->user_id = null;
    }

    public function store()
    {
        $this->validate([
		'nama_posko' => 'required',
		'alamat_posko' => 'required',
		'latitude' => 'required',
		'longitude' => 'required',
		'jumlah_pengungsi' => 'required',
		'bencana_id' => 'required',
		'kecamatan_id' => 'required',
        ]);

        Posko::create([
			'nama_posko' => $this-> nama_posko,
			'nama_petugas' => auth()->user()->name,
			'alamat_posko' => $this-> alamat_posko,
			'no_hp' => Posko::where('user_id', auth()->user()->id)->first()->no_hp,
			'latitude' => $this-> latitude,
			'longitude' => $this-> longitude,
			'jumlah_pengungsi' => $this-> jumlah_pengungsi,
			'status_posko' => 'nonaktif', // default 'nonaktif
			'bencana_id' => $this-> bencana_id,
			'kecamatan_id' => $this-> kecamatan_id,
			'user_id' => auth()->user()->id,
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Posko Successfully created.');
    }

    public function edit($id)
    {
        $record = Posko::findOrFail($id);
        $this->selected_id = $id;
		$this->nama_posko = $record-> nama_posko;
		$this->nama_petugas = $record-> nama_petugas;
		$this->alamat_posko = $record-> alamat_posko;
		$this->no_hp = $record-> no_hp;
		$this->latitude = $record-> latitude;
		$this->longitude = $record-> longitude;
		$this->jumlah_pengungsi = $record-> jumlah_pengungsi;
		$this->status_posko = $record-> status_posko;
		$this->bencana_id = $record-> bencana_id;
		$this->kecamatan_id = $record-> kecamatan_id;
		$this->user_id = $record-> user_id;
    }

    public function update()
    {
        $this->validate([
		'nama_posko' => 'required',
		'alamat_posko' => 'required',
		'latitude' => 'required',
		'longitude' => 'required',
		'jumlah_pengungsi' => 'required',
		'bencana_id' => 'required',
		'kecamatan_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Posko::find($this->selected_id);
            $record->update([
			'nama_posko' => $this-> nama_posko,
			'alamat_posko' => $this-> alamat_posko,
			'latitude' => $this-> latitude,
			'longitude' => $this-> longitude,
			'jumlah_pengungsi' => $this-> jumlah_pengungsi,
			'bencana_id' => $this-> bencana_id,
			'kecamatan_id' => $this-> kecamatan_id,
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Posko Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Posko::where('id', $id)->delete();
        }
    }

    public function aktifkan($id)
    {
        if ($id) {
            Posko::where('id', $id)->update(['status_posko' => 'aktif']);
        }
    }

    public function nonaktifkan($id)
    {
        if ($id) {
            Posko::where('id', $id)->update(['status_posko' => 'nonaktif']);
        }
    }

    public function addRow()
    {
        $this->rows[] = ['nama_barang' => '', 'quantity' => ''];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
    }

    public function saveRow(){
        $poskosID = Posko::find($this->selected_id)->id;
        $this->validate();
        foreach ($this->rows as $index => $row) {
            // simpan kebutuhan posko
            KebutuhanPosko::create([
                'posko_id' => $poskosID,
                'barang_id' => $row['barang_id'],
                'jumlah_kebutuhan' => $row['quantity'],
                'jenis_kebutuhan' => 'utama',
                'status_kebutuhan' => 'pending',
                'satuan_id' => $row['satuan_id'],
            ]);
        }

        // Reset atau bersihkan data setelah penyimpanan
        $this->rows = [];

        // Tutup modal setelah penyimpanan data
        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        return redirect('/kebutuhan_poskos')->with('message', 'Kebutuhan berhasil disimpan');
    }

    public function distribusi($id){
        // status kebutuhan menjadi terdistribusi
        KebutuhanPosko::where('id', $id)->update(['status_kebutuhan' => 'terdistribusi']);

        session()->flash('message', 'Kebutuhan berhasil didistribusikan');
    }
}
