<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dokumentasi;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Dokumentasis extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $keterangan, $gambar_penyerahan, $pdf_laporan, $user_id;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.dokumentasis.view', [
            'dokumentasis' => Dokumentasi::latest()
                        ->join('users', 'users.id', '=', 'dokumentasis.user_id')
                        // join table poskos berdasarkan user_id
                        ->join('poskos', 'poskos.user_id', '=', 'users.id')
                        ->join('bencanas', 'bencanas.id', '=', 'poskos.bencana_id')
                        ->select('dokumentasis.*', 'users.name', 'poskos.nama_posko', 'bencanas.nama_bencana')
                        // jika role = kedaruratan maka hanya menampilkan data yang dibuat oleh user tersebut
                        ->when(auth()->user()->role == 'kedaruratan', function ($query) {
                            return $query->where('dokumentasis.user_id', auth()->user()->id);
                        })
						->orWhere('keterangan', 'LIKE', $keyWord)
						->orWhere('gambar_penyerahan', 'LIKE', $keyWord)
						->orWhere('pdf_laporan', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->keterangan = null;
		$this->gambar_penyerahan = null;
		$this->pdf_laporan = null;
    }

    public function store()
    {
        $this->validate([
		'keterangan' => 'required',
        ]);

        // jika ada gambar yang diupload
        if ($this->gambar_penyerahan) {
            $imageName = md5($this->gambar_penyerahan.microtime().'.'.$this->gambar_penyerahan->extension());
            \Storage::disk('public')->putFileAs('dokumentasis', $this->gambar_penyerahan, $imageName);
        } else {
            $imageName = null;
        }

        // jika ada pdf yang diupload
        if ($this->pdf_laporan) {
            $pdfName = md5($this->pdf_laporan.microtime().'.'.$this->pdf_laporan->extension());
            \Storage::disk('public')->putFileAs('dokumentasis', $this->pdf_laporan, $pdfName);
        } else {
            $pdfName = null;
        }

        try {
            Dokumentasi::create([
                                'user_id' => auth()->user()->id,
                                'keterangan' => $this-> keterangan, 
                                'gambar_penyerahan' => $imageName,
                                'pdf_laporan' => $pdfName,
                            ]);
                            
            session()->flash('message', 'Dokumentasi successfully created.');
            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function edit($id)
    {
        $record = Dokumentasi::findOrFail($id);
        $this->selected_id = $id; 
		$this->keterangan = $record-> keterangan;
		$this->gambar_penyerahan = $record-> gambar_penyerahan;
		$this->pdf_laporan = $record-> pdf_laporan;
    }

    public function update()
    {
        $this->validate([
		'keterangan' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Dokumentasi::find($this->selected_id);
            $record->update([ 
			'keterangan' => $this-> keterangan,
			'gambar_penyerahan' => $this-> gambar_penyerahan,
			'pdf_laporan' => $this-> pdf_laporan
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Dokumentasi Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Dokumentasi::where('id', $id)->delete();
        }
    }

    public function konfirmasi($id)
    {
        $record = Dokumentasi::findOrFail($id);
        $this->selected_id = $id;
        $record->update([
            'status' => 'konfirmasi'
        ]);
    }
}