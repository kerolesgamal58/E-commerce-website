<div class="tab-pane fade" id="product_media" role="tabpanel" aria-labelledby="contact-tab">
    <h4 class="mt-4 mb-4">{{ __('admin.product_media') }}</h4>
    <div class="form-group">
        <label for="exampleInputFile">{{ __('admin.product_main_image') }}</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="main_image">
            <label class="custom-file-label" for="exampleInputFile">{{ __('admin.choose_file') }}</label>
        </div>
        @error('main_image')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputFile">{{ __('admin.product_images') }}</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="image[]" multiple>
            <label class="custom-file-label" for="exampleInputFile">{{ __('admin.choose_file') }}</label>
        </div>
        @error('image')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
