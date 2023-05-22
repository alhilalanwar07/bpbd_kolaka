<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Bencana;

class Bencanas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nama_bencana, $deskripsi_bencana;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.bencanas.view', [
            'bencanas' => Bencana::latest()
						->orWhere('nama_bencana', 'LIKE', $keyWord)
						->orWhere('deskripsi_bencana', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->nama_bencana = null;
		$this->deskripsi_bencana = null;
    }

    public function store()
    {
        $this->validate([
		'nama_bencana' => 'required',
		'deskripsi_bencana' => 'required',
        ]);

        Bencana::create([ 
			'nama_bencana' => $this-> nama_bencana,
			'deskripsi_bencana' => $this-> deskripsi_bencana
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Bencana Successfully created.');
    }

    public function edit($id)
    {
        $record = Bencana::findOrFail($id);
        $this->selected_id = $id; 
		$this->nama_bencana = $record-> nama_bencana;
		$this->deskripsi_bencana = $record-> deskripsi_bencana;
    }

    public function update()
    {
        $this->validate([
		'nama_bencana' => 'required',
		'deskripsi_bencana' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Bencana::find($this->selected_id);
            $record->update([ 
			'nama_bencana' => $this-> nama_bencana,
			'deskripsi_bencana' => $this-> deskripsi_bencana
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Bencana Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Bencana::where('id', $id)->delete();
        }
    }
}