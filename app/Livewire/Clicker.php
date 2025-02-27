<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Clicker extends Component
{

    // second way
    #[Rule('required|min:2|max:50')]
    public $name = "";
    #[Rule('required|email|unique:users')]
    public $email = "";
    #[Rule('required|min:5')]
    public $password = "";

    public function createNewUser()
    {

        // first way
        // $this->validate([
        //     'name' => 'required|min:2|max:50',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:5'
        // ]);

        $this->validate();

        User::create([
            'name' => $this->name,
            "email" => $this->email,
            "password" => $this->password
        ]);

        request()->session()->flash('success','User Created Successfully!');
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.clicker', ['users' => $users]);
    }
}
