<?php

namespace App\Http\Livewire;

use App\Models\Stok;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Logistik;
use Livewire\Component;
use Livewire\WithPagination;

class Stoks extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $barang_id, $satuan_id, $jumlah_masuk, $tgl_masuk, $harga_satuan, $total_harga;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.stoks.view', [
            'stoks' => Stok::join('barangs', 'barangs.id', '=', 'stoks.barang_id')
                        ->join('satuans', 'satuans.id', '=', 'stoks.satuan_id')
                        ->select('stoks.*', 'barangs.nama_barang', 'satuans.nama_satuan')
                        ->latest()
						->orWhere('barang_id', 'LIKE', $keyWord)
						->orWhere('satuan_id', 'LIKE', $keyWord)
						->orWhere('jumlah_masuk', 'LIKE', $keyWord)
						->orWhere('tgl_masuk', 'LIKE', $keyWord)
						->orWhere('harga_satuan', 'LIKE', $keyWord)
						->orWhere('total_harga', 'LIKE', $keyWord)
						->paginate(30),
            'barangs' => Barang::orderBy('created_at', 'DESC')->get(),
            'satuans' => Satuan::orderBy('created_at', 'DESC')->get(),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
		$this->barang_id = null;
		$this->satuan_id = null;
		$this->jumlah_masuk = null;
		$this->tgl_masuk = null;
		$this->harga_satuan = null;
		$this->total_harga = null;
    }

    public function store()
    {
        $this->validate([
		'barang_id' => 'required',
		'satuan_id' => 'required',
		'jumlah_masuk' => 'required',
		'tgl_masuk' => 'required',
		'harga_satuan' => 'required',
        ]);

        Stok::create([
			'barang_id' => $this-> barang_id,
			'satuan_id' => $this-> satuan_id,
			'jumlah_masuk' => $this-> jumlah_masuk,
			'tgl_masuk' => $this-> tgl_masuk,
			'harga_satuan' => $this->harga_satuan,
			'total_harga' => $this-> harga_satuan * $this-> jumlah_masuk,
        ]);

        // menambah ke jumlah_barang di tabel logistik
        // Logistik::where('barang_id', $this->barang_id)->increment('jumlah_barang', $this->jumlah_masuk);
        // menambah ke stok di tabel barangs
        Barang::find($this->barang_id)->update([
            'stok' => $this->jumlah_masuk + Barang::find($this->barang_id)->stok,
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Stok Successfully created.');
    }

    public function edit($id)
    {
        $record = Stok::findOrFail($id);
        $this->selected_id = $id;
		$this->barang_id = $record-> barang_id;
		$this->satuan_id = $record-> satuan_id;
		$this->jumlah_masuk = $record-> jumlah_masuk;
		$this->tgl_masuk = $record-> tgl_masuk;
		$this->harga_satuan = $record-> harga_satuan;
		$this->total_harga = $record-> total_harga;
    }

    public function update()
    {
        $this->validate([
		'barang_id' => 'required',
		'satuan_id' => 'required',
		'jumlah_masuk' => 'required',
		'tgl_masuk' => 'required',
		'harga_satuan' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Stok::find($this->selected_id);

            $barang = Barang::find($this->barang_id)->update([
                'stok' => $this->jumlah_masuk + Barang::find($this->barang_id)->stok - $record->jumlah_masuk,
            ]);

            $record->update([
			'barang_id' => $this-> barang_id,
			'satuan_id' => $this-> satuan_id,
			'jumlah_masuk' => $this-> jumlah_masuk,
			'tgl_masuk' => $this-> tgl_masuk,
			'harga_satuan' => $this-> harga_satuan,
			'total_harga' => $this-> harga_satuan * $this-> jumlah_masuk,
            ]);

            

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Stok Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Stok::where('id', $id)->delete();
        }
    }
}
