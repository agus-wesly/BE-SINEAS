@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    </div>

    <div class="card-body">
       <form method="POST" action="{{ route("film-selling.store") }}">
           @csrf
           <div class="row">
               <div class="container col-6">
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">{{ trans('global.create') }} {{ trans('cruds.filmSelling.title_singular') }}</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               <div class="form-group col">
                                   <label for="name">{{trans('cruds.filmSelling.fields.name')}}</label>
                                   <input type="text"
                                          value="{{ old('name', '') }}"
                                          class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                          id="name"
                                          name="name"
                                          aria-describedby="nameHelp"
                                          placeholder="Masukkan Nama"
                                          required
                                   >
                                   @if($errors->has('name'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('name') }}
                                       </div>
                                   @endif
                               </div>
                               <div class="form-group col">
                                   <label for="film_id">{{trans('cruds.filmSelling.fields.id_film')}}</label>
                                   <select class="form-control" name="film_id" id="film_id" required>
                                       <option>Pilih</option>
                                       @foreach($films as $film)
                                           <option value="{{ $film?->id }}" @selected(old('film_id', '') === (int) $film?->id)>{{ $film?->title }}</option>
                                       @endforeach
                                   </select>
                                   @if($errors->has('film_id'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('film_id') }}
                                       </div>
                                   @endif
                               </div>
                               <div class="form-group col">
                                   <label for="expired_date">{{trans('cruds.filmSelling.fields.expired_date')}}</label>
                                   <input type="date"
                                          value="{{ old('expired_date', '') }}"
                                          class="form-control {{ $errors->has('expired_date') ? 'is-invalid' : '' }}"
                                          id="expired_date"
                                          name="expired_date"
                                          aria-describedby="expired_dateHelp"
                                          required
                                   >
                                   @if($errors->has('expired_date'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('expired_date') }}
                                       </div>
                                   @endif
                               </div>
                               <div class="form-group col">
                                   <label for="film_selling_price_id">{{trans('cruds.filmSelling.fields.film_selling_price')}}</label>
                                   <select class="form-control" name="film_selling_price_id" id="film_selling_price_id" required>
                                       <option>Pilih</option>
                                       @foreach($filmSellingPrices as $filmSellingPrice)
                                           <option value="{{ $filmSellingPrice?->id }}" @selected(old('film_selling_price_id', '') === (string) $filmSellingPrice?->id)>{{ $filmSellingPrice?->name }}</option>
                                       @endforeach
                                   </select>
                                   @if($errors->has('film_selling_price_id'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('film_selling_price_id') }}
                                       </div>
                                   @endif
                               </div>
                               <div class="form-group col">
                                   <label for="status">{{trans('cruds.filmSelling.fields.status')}}</label>
                                   <select class="form-control" name="status" id="status" required>
                                       <option>Pilih</option>
                                       @foreach(\App\Models\FilmSelling::STATUS_FILM_SELECTED as $key => $label)
                                           <option value="{{ $key }}" @selected(old('status', '') === (string) $key)>{{ $label }}</option>
                                       @endforeach
                                   </select>
                                   @if($errors->has('status'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('status') }}
                                       </div>
                                   @endif
                               </div>
                               <div class="form-group col">
                                   <label for="is_free">{{trans('cruds.filmSelling.fields.is_fee')}}</label>
                                   <select class="form-control" name="is_free" id="is_free" required>
                                       <option>Pilih</option>
                                       @foreach(\App\Models\FilmSelling::IS_FEE_SELECTED as $key => $label)
                                           <option value="{{ $key }}" @selected(old('is_free', '') === (int) $key)>{{ $label }}</option>
                                       @endforeach
                                   </select>
                                   @if($errors->has('is_free'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('is_free') }}
                                       </div>
                                   @endif
                               </div>
                            </div>
                           <div class="mb-3 ml-4">
                               <button style="width: 130px" type="submit" class="btn btn-success">Simpan</button>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </form>
    </div>
</div>
@endsection
