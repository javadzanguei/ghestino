    <select wire:model="county_id" class="form-select" id="county" name="county" aria-label="شهرستان" required>
        <option value="" selected>شهرستان</option>
    @foreach(\App\Models\Country\County::whereProvinceId($province)->get() as $county)
        <option value="{{$county->id}}">{{$county->name}}</option>
    @endforeach
    </select>