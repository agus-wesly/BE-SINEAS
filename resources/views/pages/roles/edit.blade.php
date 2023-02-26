@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.supplier.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.suppliers.update", [$supplier->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.supplier.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $supplier->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.supplier.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $supplier->phone_number) }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.supplier.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $supplier->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ktp_photo">{{ trans('cruds.supplier.fields.ktp_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('ktp_photo') ? 'is-invalid' : '' }}" id="ktp_photo-dropzone">
                </div>
                @if($errors->has('ktp_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ktp_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.ktp_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="store_photo">{{ trans('cruds.supplier.fields.store_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('store_photo') ? 'is-invalid' : '' }}" id="store_photo-dropzone">
                </div>
                @if($errors->has('store_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.store_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.supplier.fields.channel') }}</label>
                <select class="form-control {{ $errors->has('channel') ? 'is-invalid' : '' }}" name="channel" id="channel" required>
                    <option value disabled {{ old('channel', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Supplier::CHANNEL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('channel', $supplier->channel) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('channel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('channel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.channel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.supplier.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Supplier::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $supplier->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.supplier.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.ktpPhotoDropzone = {
    url: '{{ route('admin.suppliers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="ktp_photo"]').remove()
      $('form').append('<input type="hidden" name="ktp_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="ktp_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($supplier) && $supplier->ktp_photo)
      var file = {!! json_encode($supplier->ktp_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="ktp_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
