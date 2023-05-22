<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Barang;

class Barangs extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nama_barang, $status_barang;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.barangs.view', [
            'barangs' => Barang::latest()
						->orWhere('nama_barang', 'LIKE', $keyWord)
						->orWhere('status_barang', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
		$this->nama_barang = null;
		$this->status_barang = null;
    }

    public function store()
    {
        $this->validate([
		'nama_barang' => 'required',
        ]);

        Barang::create([
			'nama_barang' => $this-> nama_barang,
			'status_barang' => 'tersedia',
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Barang Successfully created.');
    }

    public function edit($id)
    {
        $record = Barang::findOrFail($id);
        $this->selected_id = $id;
		$this->nama_barang = $record-> nama_barang;
		$this->status_barang = $record-> status_barang;
    }

    public function update()
    {
        $this->validate([
		'nama_barang' => 'required',
		'status_barang' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Barang::find($this->selected_id);
            $record->update([
			'nama_barang' => $this-> nama_barang,
			'status_barang' => $this-> status_barang
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Barang Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Barang::where('id', $id)->delete();
        }
    }
}
