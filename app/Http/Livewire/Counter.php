<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Counter extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.counter', [
            'users' => User::where('name', $this->search)->get(),
        ]);
    }

//    public function render()
//    {
//        return view('livewire.counter');
//    }
}
