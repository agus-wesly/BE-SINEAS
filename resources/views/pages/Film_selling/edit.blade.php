@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.sineashub') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("film-selling-price.update", [$filmSelling->film_selling_price_id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="container col-6">
                <div class="card">
                    <div>
                        <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">{{ trans('global.edit') }} Film Selling</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            <input type="hidden"
                                value="{{ old('name', $filmSelling->name) }}"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="name"
                                name="name"
                                aria-describedby="nameHelp"
                                placeholder="Masukkan Nama"
                                required>
                            <div class="form-group col">
                                <label for="duration">{{trans('cruds.filmSelling.fields.duration')}}</label>
                                <input type="number"
                                    value="{{ old('duration', $filmSelling->duration) }}"
                                    class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}"
                                    id="duration"
                                    name="duration"
                                    aria-describedby="durationHelp"
                                    placeholder="99"
                                    required>
                                @if($errors->has('duration'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('duration') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="price">{{trans('cruds.filmSelling.fields.price')}}</label>
                                <input type="number"
                                    value="{{ old('price', $filmSelling->price) }}"
                                    class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                    id="price"
                                    name="price"
                                    aria-describedby="priceHelp"
                                    placeholder="999999"
                                    required>
                                @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                                @endif
                            </div>

                            <input type="hidden" name="id" value="{{$filmSelling->id}}"/>

                            <div class="form-group col">
                                <label for="price">Status Film</label>

                                <select class="form-control" name="is_free" id="is_free" required>
                                    <option disabled>Pilih</option>
                                    <option value="0" @selected($filmSelling->is_free == 0)>Berbayar</option>
                                    <option value="1" @selected($filmSelling->is_free == 1)>Gratis</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3 ml-4">
                        <button style="width: 130px" type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
