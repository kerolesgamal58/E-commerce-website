<div class="tab-pane fade" id="product_size_weight" role="tabpanel" aria-labelledby="contact-tab">
    <h4 class="mt-4 mb-4">{{ __('admin.product_shipping_info') }}</h4>
    <div class="choose_department_message">
        <center>{{ __('admin.choose_department') }}</center>
    </div>
    <div class="row">
        <div class="form-group additional-data d-none col-md-6">
            <label for="">{{ __('admin.color') }}</label>
            <select class="form-control" aria-label="Default select example" id="selectColor" name="color_id">
                <option value="" color="white">{{ __('admin.choose_product_color') }}</option>
                @foreach(\App\Models\Color::all() as $color)
                    <option value="{{ $color->id }}" color="{{ $color->color }}" @if(old('color_id') == $color->id) selected @endif>
                        {{ $color->{'name_' . LaravelLocalization::getCurrentLocale()} }}
                    </option>
                @endforeach
            </select>
            <span id="colorField" style="border-radius: 4px; background-color: white; display: block; width: 50px; height: 50px; margin-top: 10px"></span>
            @error('color_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group additional-data d-none col-md-6">
            <label for="">{{ __('admin.trademark') }}</label>
            <select class="form-control" aria-label="Default select example" id="selectTrademark" name="trademark_id">
                <option value="">{{ __('admin.choose_trademark') }}</option>
                @foreach(\App\Models\TradeMark::all() as $trademark)
                    <option value="{{ $trademark->id }}" trademark_logo="{{ asset('storage/' . $trademark->logo) }}" trademark_alt="{{ $trademark->name . ' logo' }}" @if(old('trademark_id') == $trademark->id) selected @endif>
                        {{$trademark->{'name_' . LaravelLocalization::getCurrentLocale()} }}
                    </option>
                @endforeach
            </select>
            <img src="" alt="" class="d-none mt-2" id="trademark_logo" style="width: 50px; height: 50px; border-radius: 4px">
            @error('trademark_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group additional-data d-none col-md-6">
            <label for="">{{ __('admin.manufacture') }}</label>
            <select class="form-control" aria-label="Default select example" id="selectColor" name="manufacture_id">
                <option value="">{{ __('admin.choose_manufacture') }}</option>
                @foreach(\App\Models\Manufact::all() as $manufact)
                    <option value="{{ $manufact->id }}" @if(old('manufacture_id') == $manufact->id) selected @endif>
                        {{$manufact->{'name_' . LaravelLocalization::getCurrentLocale()} }}
                    </option>
                @endforeach
            </select>
            @error('manufacture_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group additional-data d-none col-md-6">
            <label for="">{{ __('admin.mall') }}</label>
            <br>
            <select class="form-control" aria-label="Default select example" id="malls_select2" name="mall[]" multiple>
                @foreach(\App\Models\Country::all() as $country)
                    <optgroup label="{{$country->name}}">
                        @foreach($country->malls()->get() as $mall)
                            <option value="{{ $mall->id }}">
                                {{$mall->{'name_' . LaravelLocalization::getCurrentLocale()} }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            @error('mall')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
