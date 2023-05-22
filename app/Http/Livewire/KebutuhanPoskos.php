<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\KebutuhanPosko;

class KebutuhanPoskos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $posko_id, $barang_id, $jumlah_kebutuhan, $jenis_kebutuhan, $status_kebutuhan;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.kebutuhan-poskos.view', [
            'kebutuhanPoskos' => KebutuhanPosko::join('poskos', 'poskos.id', '=', 'kebutuhan_poskos.posko_id')
                        ->join('barangs', 'barangs.id', '=', 'kebutuhan_poskos.barang_id')
                        ->join('satuans', 'satuans.id', '=', 'kebutuhan_poskos.satuan_id')
                        ->select('kebutuhan_poskos.*', 'poskos.nama_posko', 'poskos.nama_petugas', 'barangs.nama_barang', 'satuans.nama_satuan')
                        ->latest()
						->orWhere('poskos.nama_posko', 'LIKE', $keyWord)
						->orWhere('barangs.nama_barang', 'LIKE', $keyWord)
						->orWhere('jumlah_kebutuhan', 'LIKE', $keyWord)
						->orWhere('jenis_kebutuhan', 'LIKE', $keyWord)
						->orWhere('status_kebutuhan', 'LIKE', $keyWord)
						->paginate(50),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
		$this->posko_id = null;
		$this->barang_id = null;
		$this->jumlah_kebutuhan = null;
		$this->jenis_kebutuhan = null;
		$this->status_kebutuhan = null;
    }

    public function store()
    {
        $this->validate([
		'posko_id' => 'required',
		'barang_id' => 'required',
		'jumlah_kebutuhan' => 'required',
		'jenis_kebutuhan' => 'required',
		'status_kebutuhan' => 'required',
        ]);

        KebutuhanPosko::create([
			'posko_id' => $this-> posko_id,
			'barang_id' => $this-> barang_id,
			'jumlah_kebutuhan' => $this-> jumlah_kebutuhan,
			'jenis_kebutuhan' => $this-> jenis_kebutuhan,
			'status_kebutuhan' => $this-> status_kebutuhan
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'KebutuhanPosko Successfully created.');
    }

    public function edit($id)
    {
        $record = KebutuhanPosko::findOrFail($id);
        $this->selected_id = $id;
		$this->posko_id = $record-> posko_id;
		$this->barang_id = $record-> barang_id;
		$this->jumlah_kebutuhan = $record-> jumlah_kebutuhan;
		$this->jenis_kebutuhan = $record-> jenis_kebutuhan;
		$this->status_kebutuhan = $record-> status_kebutuhan;
    }

    public function update()
    {
        $this->validate([
		'posko_id' => 'required',
		'barang_id' => 'required',
		'jumlah_kebutuhan' => 'required',
		'jenis_kebutuhan' => 'required',
		'status_kebutuhan' => 'required',
        ]);

        if ($this->selected_id) {
			$record = KebutuhanPosko::find($this->selected_id);
            $record->update([
			'posko_id' => $this-> posko_id,
			'barang_id' => $this-> barang_id,
			'jumlah_kebutuhan' => $this-> jumlah_kebutuhan,
			'jenis_kebutuhan' => $this-> jenis_kebutuhan,
			'status_kebutuhan' => $this-> status_kebutuhan
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'KebutuhanPosko Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            KebutuhanPosko::where('id', $id)->delete();
        }
    }

    public function distribusi($id){
        // status kebutuhan menjadi terdistribusi
        KebutuhanPosko::where('id', $id)->update(['status_kebutuhan' => 'terdistribusi']);

        session()->flash('message', 'Kebutuhan berhasil didistribusikan');
    }
}
