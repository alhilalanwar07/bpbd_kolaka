<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use App\Models\Satuan;
use Livewire\Component;
use App\Models\Logistik;
use Livewire\WithPagination;

class Logistiks extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $barang_id, $satuan_id, $jumlah_barang, $harga_satuan, $total_harga;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.logistiks.view', [
            'logistiks' => Logistik::join('barangs', 'barangs.id', '=', 'logistiks.barang_id')
                        ->join('satuans', 'satuans.id', '=', 'logistiks.satuan_id')
                        ->select('logistiks.*', 'barangs.nama_barang', 'satuans.nama_satuan')
                        ->latest()
						->orWhere('barang_id', 'LIKE', $keyWord)
						->orWhere('satuan_id', 'LIKE', $keyWord)
						->orWhere('jumlah_barang', 'LIKE', $keyWord)
						->orWhere('harga_satuan', 'LIKE', $keyWord)
						->orWhere('total_harga', 'LIKE', $keyWord)
						->paginate(50),
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
		$this->jumlah_barang = null;
		$this->harga_satuan = null;
		$this->total_harga = null;
    }

    public function store()
    {
        $this->validate([
		'barang_id' => 'required',
		'satuan_id' => 'required',
		'jumlah_barang' => 'required',
		'harga_satuan' => 'required',
        ]);

        Logistik::create([
			'barang_id' => $this-> barang_id,
			'satuan_id' => $this-> satuan_id,
			'jumlah_barang' => $this-> jumlah_barang,
			'harga_satuan' => $this-> harga_satuan,
			'total_harga' => $this->harga_satuan * $this->jumlah_barang,
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Logistik Successfully created.');
    }

    public function edit($id)
    {
        $record = Logistik::findOrFail($id);
        $this->selected_id = $id;
		$this->barang_id = $record-> barang_id;
		$this->satuan_id = $record-> satuan_id;
		$this->jumlah_barang = $record-> jumlah_barang;
		$this->harga_satuan = $record-> harga_satuan;
		$this->total_harga = $record-> total_harga;
    }

    public function update()
    {
        $this->validate([
		'barang_id' => 'required',
		'satuan_id' => 'required',
		'jumlah_barang' => 'required',
		'harga_satuan' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Logistik::find($this->selected_id);
            $record->update([
			'barang_id' => $this-> barang_id,
			'satuan_id' => $this-> satuan_id,
			'jumlah_barang' => $this-> jumlah_barang,
			'harga_satuan' => $this-> harga_satuan,
			'total_harga' => $this->harga_satuan * $this->jumlah_barang,
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Logistik Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Logistik::where('id', $id)->delete();
        }
    }
}
