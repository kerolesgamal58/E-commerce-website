<div class="tab-pane fade" id="other_data" role="tabpanel" aria-labelledby="contact-tab">
    <h4 class="mt-4 mb-4">{{ __('admin.other_data') }}</h4>
    <div class="row-inputs">
        @foreach($other_data as $data)
            <div class="contain row">
                <div class="form-group col-md-4">
                    <label for="input_key">{{ __('admin.input_key') }}</label>
                    <input type="text" class="form-control" name="input_key[]" value="{{ $data->data_key }}">
                </div>
                <div class="form-group col-md-7">
                    <label for="input_value">{{ __('admin.input_value') }}</label>
                    <input type="text" class="form-control" name="input_value[]" value="{{ $data->data_value }}">
                </div>
                <div class="form-group col-md-1">
                    <button class="btn btn-primary mt-4 remove-input"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        @endforeach
    </div>
    <button class="btn btn-secondary add_input"><i class="fa fa-plus"></i></button>
</div>
