<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Users extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $email, $role, $password;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.users.view', [
            'users' => User::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->orWhere('role', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
		$this->name = null;
		$this->email = null;
		$this->role = null;
        $this->password = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'email' => 'required',
		'role' => 'required',
        'password' => 'required'
        ]);

        User::create([
			'name' => $this-> name,
			'email' => $this-> email,
			'role' => $this-> role,
            'password' => bcrypt($this->password)
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'User Successfully created.');
    }

    public function edit($id)
    {
        $record = User::findOrFail($id);
        $this->selected_id = $id;
		$this->name = $record-> name;
		$this->email = $record-> email;
		$this->role = $record-> role;

    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'email' => 'required',
		'role' => 'required',
        ]);

        if ($this->selected_id) {
            if($this->password != null){
                $record = User::find($this->selected_id);
                $record->update([
                    'name' => $this-> name,
                    'email' => $this-> email,
                    'role' => $this-> role,
                    'password' => bcrypt($this->password)
                ]);
            }else{
                $record = User::find($this->selected_id);
                $record->update([
                    'name' => $this-> name,
                    'email' => $this-> email,
                    'role' => $this-> role
                ]);
            }

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'User Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            User::where('id', $id)->delete();
        }
    }
}
