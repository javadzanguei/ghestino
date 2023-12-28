<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Offline extends Component
{
    public function render(): string
    {
        return <<<'blade'
            <div class="offline-alert" wire:offline>
                ارتباط شما با سرور برقرار نیست.
            </div>
        blade;
    }
}
