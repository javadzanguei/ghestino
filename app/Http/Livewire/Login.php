<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $form;

    public function mount()
    {
        $this->form = 'user';
    }
    public function render()
    {
        return view('livewire.login');
    }
}
