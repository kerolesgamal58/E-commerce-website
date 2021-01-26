<div class="tab-pane fade show active" id="product_info" role="tabpanel" aria-labelledby="home-tab">
    <h4 class="mt-4 mb-4">{{ __('admin.product_info') }}</h4>
    <div class="form-group has-validation">
        <label for="exampleInputEmail1">{{ __('admin.product_title') }}</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        @error('title')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group has-validation">
        <label for="exampleInputEmail1">{{ __('admin.product_description') }}</label>
        <textarea class="form-control" rows="5" name="description">
            {{ old('description') }}
        </textarea>
        @error('description')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
