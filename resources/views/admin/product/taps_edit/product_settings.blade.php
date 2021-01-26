<div class="tab-pane fade" id="product_settings" role="tabpanel" aria-labelledby="profile-tab">
    <h4 class="mt-4 mb-4">{{ __('admin.product_settings') }}</h4>
    <div class="row">
        <div class="form-group col-md-6">
            <label>{{ __('admin.price_currency') }}</label>
            <select class="form-control" aria-label="Default select example" id="selectColor" name="currency_id">
                <option value="">{{ __('admin.choose_currency') }}</option>
                @foreach(\App\Models\Country::all() as $country)
                    <option value="{{ $country->id }}" @if($product->currency_id == $country->id) selected @endif>
                        {{$country->currency}}
                    </option>
                @endforeach
            </select>
            @error('currency_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label>{{ __('admin.price') }}</label>
            <input type="text" class="form-control"name="price" value="{{ $product->price }}">
            @error('price')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group has-validation">
        <label for="exampleInputEmail1">{{ __('admin.stock') }}</label>
        <input type="text" class="form-control" placeholder="Enter stock" name="stock" value="{{ $product->stock }}">
        @error('stock')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="row">
        <div class="form-group has-validation col-sm-6 col-xs-12">
            <label for="exampleInputEmail1">{{ __('admin.start_at') }}</label>
            <input type="text" class="form-control datepicker" name="start_at" data-provide="datepicker" value="{{ $product->start_at }}">
            @error('start_at')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group has-validation col-sm-6 col-xs-12">
            <label for="exampleInputEmail1">{{ __('admin.end_at') }}</label>
            <input type="text" class="form-control datepicker" name="end_at" data-provide="datepicker" value="{{ $product->end_at }}">
            @error('end_at')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group has-validation ">
        <label for="exampleInputEmail1">{{ __('admin.price_offer') }}</label>
        <input type="text" class="form-control" name="price_offer" value="{{ $product->price_offer }}">
        @error('price_offer')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="row">
        <div class="form-group has-validation col-sm-6 col-xs-12">
            <label for="exampleInputEmail1">{{ __('admin.start_offer_at') }}</label>
            <input type="text" class="form-control datepicker" name="start_offer_at" data-provide="datepicker" value="{{ $product->start_offer_at }}">
            @error('start_offer_at')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group has-validation col-sm-6 col-xs-12">
            <label for="exampleInputEmail1">{{ __('admin.end_offer_at') }}</label>
            <input type="text" class="form-control datepicker" name="end_offer_at" data-provide="datepicker" value="{{ $product->end_offer_at }}">
            @error('end_offer_at')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">{{ __('admin.status') }}</label>
            <select class="form-control" id="status" aria-label="Default select example" name="status">
                <option value="pending" @if($product->status == 'pending') selected @endif>{{ __('admin.pending') }}</option>
                <option value="refused" @if($product->status == 'refused') selected @endif>{{ __('admin.refused') }}</option>
                <option value="active" @if($product->status == 'active') selected @endif>{{ __('admin.active') }}</option>
            </select>
            @error('status')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group reason d-none">
            <label for="exampleInputEmail1">{{ __('admin.refuse_reason') }}</label>
            <textarea class="form-control" rows="5"name="reason">
                {{ $product->reason }}
            </textarea>
            @error('reason')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
