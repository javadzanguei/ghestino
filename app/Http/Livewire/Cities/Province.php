<?php

namespace App\Http\Livewire\Cities;

use Livewire\Component;

class Province extends Component
{
    public $province_id = 0;

    public function updatedProvinceId()
    {
        $this->emit('showCounties', $this->province_id);
        $this->emitUp('showProvinceObjects', $this->province_id);
    }

    public function render(): string
    {
        return <<<'blade'
            <select wire:model="province_id" class="form-select" name="province" id="province" aria-label="استان" required>
                <option value="" selected>استان</option>
                @foreach(\App\Models\Country\Province::all() as $province)
                    <option value="{{$province->id}}">{{$province->name}}</option>
                @endforeach
            </select>
        blade;
    }
}
