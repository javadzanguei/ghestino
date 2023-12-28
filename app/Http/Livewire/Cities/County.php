<?php

namespace App\Http\Livewire\Cities;

use Livewire\Component;

class County extends Component
{
    public $province;
    public $county_id = 0;

    protected $listeners = ['showCounties'];

    public function showCounties($province_id)
    {
        $this->province = $province_id;
    }

    public function updatedCountyId()
    {
        $this->emitUp('updateCounty', $this->county_id);
    }

    public function render()
    {
        return <<<'blade'
            <select wire:model="county_id" class="form-select" id="county" name="county" aria-label="شهرستان" required>
                <option value="" selected>شهرستان</option>
            @foreach(\App\Models\Country\County::whereProvinceId($province)->get() as $county)
                <option value="{{$county->id}}">{{$county->name}}</option>
            @endforeach
            </select>
        blade;
    }
}
