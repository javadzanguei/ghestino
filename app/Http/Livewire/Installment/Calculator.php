<?php

namespace App\Http\Livewire\Installment;

use Livewire\Component;

class Calculator extends Component
{
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.installment.calculator');
    }
}
