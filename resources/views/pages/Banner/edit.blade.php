@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.sineashub') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("banners.update", [$banner->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="container col-6">
                <div class="card">
                    <div>
                        <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">{{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            <div class="form-group">
                                <label for="title">{{trans('cruds.banner.fields.title')}}</label>
                                <input type="text"
                                       value="{{ old('title', $banner->title) }}"
                                       class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                       id="title"
                                       name="title"
                                       aria-describedby="titleHelp"
                                       placeholder="ini banner"
                                       required
                                >
                                @if($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">{{trans('global.description')}}</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                          id="description"
                                          name="description"
                                          rows="3"
                                          placeholder="ini deskripsi"
                                          required>{{ old('description', $banner->description) }}</textarea>
                                @if($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="url_link">{{trans('cruds.banner.fields.url_link')}}</label>
                                <input type="url"
                                       value="{{ old('url_link', $banner->url_link) }}"
                                       class="form-control {{ $errors->has('url_link') ? 'is-invalid' : '' }}"
                                       id="url_link"
                                       name="url_link"
                                       aria-describedby="titleHelp"
                                       placeholder="http://www.example.com/"
                                >
                                @if($errors->has('url_link'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('url_link') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">{{trans('cruds.banner.fields.image')}}</label>
                                <input type="file"
                                       value="{{ old('image', $banner->image) }}"
                                       class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                       id="image"
                                       name="image"
                                       accept="image/*"
                                       aria-describedby="imageHelp"
                                >
                                @if($errors->has('image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="expired_date">{{trans('cruds.banner.fields.expired_date')}}</label>
                                        <input type="date"
                                               value="{{ old('expired_date', $banner->expired_date) }}"
                                               class="form-control {{ $errors->has('expired_date') ? 'is-invalid' : '' }}"
                                               id="expired_date"
                                               name="expired_date"
                                               aria-describedby="titleHelp"
                                               required
                                        >
                                        @if($errors->has('expired_date'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('expired_date') }}
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">{{trans('global.status')}}</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option>Pilih</option>
                                            @foreach(\App\Models\Banner::STATUS_ACTIVE as $key => $label)
                                                <option value="{{ $key }}" @selected(old('status', $banner->status) === (int) $key)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 ml-3">
                        <button style="width: 130px" type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

