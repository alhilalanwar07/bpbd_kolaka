<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kecamatan;

class Kecamatans extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $kode_kecamatan, $nama_kecamatan, $luas_wilayah, $jumlah_penduduk;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.kecamatans.view', [
            'kecamatans' => Kecamatan::latest()
						->orWhere('kode_kecamatan', 'LIKE', $keyWord)
						->orWhere('nama_kecamatan', 'LIKE', $keyWord)
						->paginate(30),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
		$this->kode_kecamatan = null;
		$this->nama_kecamatan = null;
		$this->luas_wilayah = null;
		$this->jumlah_penduduk = null;
    }

    public function store()
    {
        $this->validate([
		'nama_kecamatan' => 'required',
		'luas_wilayah' => 'required',
		'jumlah_penduduk' => 'required',
        ]);

        // kode kecamatan = K1 dst..
        $kode_kecamatan = Kecamatan::where('kode_kecamatan', 'LIKE', 'K%')->orderBy('kode_kecamatan', 'desc')->first();

        if ($kode_kecamatan) {
            $kode_kecamatan = $kode_kecamatan->kode_kecamatan;
            $kode_kecamatan = substr($kode_kecamatan, 1);
            $kode_kecamatan = intval($kode_kecamatan);
            $kode_kecamatan = 'K'.($kode_kecamatan + 1);
        } else {
            $kode_kecamatan = 'K1';
        }

        Kecamatan::create([
			'kode_kecamatan' => $kode_kecamatan,
			'nama_kecamatan' => $this-> nama_kecamatan,
			'luas_wilayah' => $this-> luas_wilayah,
			'jumlah_penduduk' => $this-> jumlah_penduduk
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Kecamatan Successfully created.');
    }

    public function edit($id)
    {
        $record = Kecamatan::findOrFail($id);
        $this->selected_id = $id;
		$this->kode_kecamatan = $record-> kode_kecamatan;
		$this->nama_kecamatan = $record-> nama_kecamatan;
		$this->luas_wilayah = $record-> luas_wilayah;
		$this->jumlah_penduduk = $record-> jumlah_penduduk;
    }

    public function update()
    {
        $this->validate([
		'nama_kecamatan' => 'required',
		'luas_wilayah' => 'required',
		'jumlah_penduduk' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Kecamatan::find($this->selected_id);
            $record->update([
			'nama_kecamatan' => $this-> nama_kecamatan,
			'luas_wilayah' => $this-> luas_wilayah,
			'jumlah_penduduk' => $this-> jumlah_penduduk
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Kecamatan Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Kecamatan::where('id', $id)->delete();
        }
    }
}
