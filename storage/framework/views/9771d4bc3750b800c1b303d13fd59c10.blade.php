    <select wire:model="province_id" class="form-select" name="province" id="province" aria-label="استان" required>
        <option value="" selected>استان</option>
        @foreach(\App\Models\Country\Province::all() as $province)
            <option value="{{$province->id}}">{{$province->name}}</option>
        @endforeach
    </select>