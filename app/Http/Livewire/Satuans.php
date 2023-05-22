<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Satuan;

class Satuans extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nama_satuan;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.satuans.view', [
            'satuans' => Satuan::latest()
						->orWhere('nama_satuan', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->nama_satuan = null;
    }

    public function store()
    {
        $this->validate([
		'nama_satuan' => 'required',
        ]);

        Satuan::create([ 
			'nama_satuan' => $this-> nama_satuan
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Satuan Successfully created.');
    }

    public function edit($id)
    {
        $record = Satuan::findOrFail($id);
        $this->selected_id = $id; 
		$this->nama_satuan = $record-> nama_satuan;
    }

    public function update()
    {
        $this->validate([
		'nama_satuan' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Satuan::find($this->selected_id);
            $record->update([ 
			'nama_satuan' => $this-> nama_satuan
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Satuan Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Satuan::where('id', $id)->delete();
        }
    }
}