@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.sineashub') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("taxes.update", [$tax->id]) }}">
            @method('PUT')
            @csrf
            <div class="container col-6">
                <div class="card">
                    <div>
                        <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">{{ trans('global.edit') }} Genre</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            <div class="form-group">
                                <label for="name">Name Taxes</label>
                                <input type="text"
                                       value="{{ old('name', $tax->name) }}"
                                       class="form-control"
                                       id="name"
                                       name="name"
                                       aria-describedby="nameHelp"
                                       placeholder="Admin"
                                       required
                                >
                            </div>
                            <div class="form-group">
                                <label for="price">{{trans('global.price')}}</label>
                                <input type="text"
                                       value="{{ old('price', $tax->price) }}"
                                       class="form-control"
                                       id="price"
                                       name="price"
                                       aria-describedby="priceHelp"
                                       placeholder="55"
                                       required
                                >
                            </div>
                            <div class="form-group">
                                <label for="status">{{trans('global.status')}}</label>
                                <select class="form-control" name="status" id="status" required>
                                    @foreach(\App\Models\Tax::STATUS_ACTIVE as $key => $label)
                                        <option value="{{ $key }}" @selected(old('status', $tax->status) === (int) $key)>{{ $label }}</option>
                                    @endforeach
                                </select>
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

