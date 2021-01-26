<div class="form-group row">
    <label for="">{{ __('admin.size') }}</label>
    <div class="col-md-3">
        <select class="form-control" aria-label="Default select example" name="size_id">
            <option value="">{{ __('admin.choose_size_category') }}</option>
            @foreach($sizes as $size)
                <option value="{{ $size['id'] }}" @if( !is_null($product) and $size['id'] == $product->size_id) selected @endif>
                    {{$size['name']}}
                </option >
            @endforeach
        </select>
        @error('size_id')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-9">
        <input type="text" class="form-control" placeholder="{{ __('admin.enter_product_size') }}" name="size" value="@if(!is_null($product)) {{ $product->size }} @endif">
        @error('size')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="">{{ __('admin.weight') }}</label>
    <div class="col-md-3">
        <select class="form-control" aria-label="Default select example" name="weight_id">
            <option value="">{{ __('admin.choose_weight_category') }}</option>
            @foreach($weights as $weight)
                <option value="{{ $weight['id'] }}" @if( !is_null($product) and $weight['id'] == $product->weight_id) selected @endif>
                    {{$weight['name']}}
                </option>
            @endforeach
        </select>
        @error('weight_id')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-9">
        <input type="text" class="form-control" placeholder="{{ __('admin.enter_product_weight') }}" name="weight" value="@if(!is_null($product)) {{ $product->weight }} @endif">
        @error('weight')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
