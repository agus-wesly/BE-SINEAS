@extends('layouts.admin')


@section('content')

{{--<header class="bg-white shadow">--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 py-3 px-4">--}}
{{--                <h2 class="font-semibold text-xl text-success">--}}
{{--                    {{ __('Profile') }}--}}
{{--                </h2>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('profile.partials.profile-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
