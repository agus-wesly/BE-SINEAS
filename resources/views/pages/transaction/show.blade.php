@extends('layouts.admin')
@section('content')

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('movie.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.film.fields.id') }}
                    </th>
                    <td>
                        {{ $film?->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.film.fields.title_film') }}
                    </th>
                    <td>
                        {{ $film?->title }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.film.fields.duration') }}
                    </th>
                    <td>
                        {{ $film?->duration }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.film.fields.description') }}
                    </th>
                    <td>
                        {{ $film?->desc }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.film.fields.url_film') }}
                    </th>
                    <td>
                        {{ $film?->url_film }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.film.fields.url_trailer') }}
                    </th>
                    <td>
                        {{ $film?->url_trailer }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.film.fields.film_date') }}
                    </th>
                    <td>
                        {{ $film?->date }}
                    </td>
                </tr>
                <tr>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>
                                Nama
                            </th>
                            <th>
                                Posisi
                            </th>
                        </tr>
                       @forelse($film->information as $info)
                            <tr>
                                <td>
                                    {{ $info?->value }}
                                </td>
                                <td>
                                    {{ $info?->name }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">
                                    <p class="text-center">Tidak ada data</p>
                                </td>
                            </tr>
                        @endforelse
                    </table>

                </tr>
                <tr>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>
                                Nama Actor
                            </th>
                        </tr>
                        @forelse($film->actors as $actor)
                            <tr>
                                <td>
                                    {{ $actor?->name }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">
                                    <p class="text-center">Tidak ada data</p>
                                </td>
                            </tr>
                        @endforelse
                    </table>

                </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('movie.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>

@endsection
