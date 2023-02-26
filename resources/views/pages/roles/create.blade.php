@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
    </div>

    <div class="card-body">
       <form method="POST" action="{{ route("roles.store") }}">
           @csrf
           <div class="row">
               <div class="container col-6">
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">{{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               <div class="form-group">
                                   <label for="name">Nama Role</label>
                                   <input type="text"
                                          value="{{ old('name', '') }}"
                                          class="form-control"
                                          id="name"
                                          name="name"
                                          aria-describedby="supplierHelp"
                                          placeholder="Admin"
                                          required
                                   >
                               </div>
                            </div>
                       </div>
                       <div class="mb-3 ml-3">
                           <button style="width: 130px" type="submit" class="btn btn-success">Simpan</button>
                       </div>
                   </div>
               </div>
           </div>
       </form>
    </div>
</div>
@endsection
