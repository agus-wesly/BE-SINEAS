@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    </div>

    <div class="card-body">
       <form method="POST" action="{{ route("film-selling-price.store") }}">
           @csrf
           <div class="row">
               <div class="container col-6">
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">{{ trans('global.create') }} {{ trans('cruds.filmSellingPrice.title_singular') }}</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               <div class="form-group col">
                                   <label for="name">{{trans('cruds.filmSellingPrice.fields.name')}}</label>
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
                                   <label for="duration">{{trans('cruds.filmSellingPrice.fields.duration')}}</label>
                                   <input type="number"
                                          value="{{ old('duration', '') }}"
                                          class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}"
                                          id="duration"
                                          name="duration"
                                          aria-describedby="durationHelp"
                                          placeholder="99"
                                          required
                                   >
                                   @if($errors->has('duration'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('duration') }}
                                       </div>
                                   @endif
                               </div>
                               <div class="form-group col">
                                   <label for="price">{{trans('cruds.filmSellingPrice.fields.price')}}</label>
                                   <input type="number"
                                          value="{{ old('price', '') }}"
                                          class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                          id="price"
                                          name="price"
                                          aria-describedby="priceHelp"
                                          placeholder="999999"
                                          required
                                   >
                                   @if($errors->has('price'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('price') }}
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
