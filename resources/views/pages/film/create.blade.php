@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.film.title_singular') }}
    </div>

    <div class="card-body">
       <form method="POST" action="{{ route('movie.store') }}" enctype="multipart/form-data">
           @csrf
           <div class="row">
               <div class="container">
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">Data {{trans('cruds.film.title_singular')}}</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                              <div class="row">
                                  <div class="form-group col-4">
                                      <label for="title">Judul {{trans('cruds.film.title_singular')}}</label>
                                      <input type="text"
                                             value="{{ old('title', '') }}"
                                             class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                             id="title"
                                             name="title"
                                             aria-describedby="titleHelp"
                                             placeholder="doraemon"
                                             required
                                      >
                                      @if($errors->has('title'))
                                          <div class="invalid-feedback">
                                              {{ $errors->first('title') }}
                                          </div>
                                      @endif
                                  </div>
                                  <div class="form-group col-2">
                                      <label for="duration">{{trans('cruds.film.fields.duration')}}</label>
                                      <input type="time"
                                             value="{{ old('duration', '') }}"
                                             class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}"
                                             id="duration"
                                             name="duration"
                                             aria-describedby="durationHelp"
                                             required
                                      >
                                      @if($errors->has('duration'))
                                          <div class="invalid-feedback">
                                              {{ $errors->first('duration') }}
                                          </div>
                                      @endif
                                  </div>
                                  <div class="form-group col-2">
                                      <label for="date">{{trans('cruds.film.fields.film_date')}}</label>
                                      <input type="date"
                                             value="{{ old('date', '') }}"
                                             class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                             id="date"
                                             name="date"
                                             aria-describedby="durationHelp"
                                             required
                                      >
                                      @if($errors->has('duration'))
                                          <div class="invalid-feedback">
                                              {{ $errors->first('duration') }}
                                          </div>
                                      @endif
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group col-4">
                                      <label for="penulis">{{trans('cruds.film.fields.author')}}</label>
                                      <input type="text"
                                             value="{{ old('penulis', '') }}"
                                             class="form-control {{ $errors->has('penulis') ? 'is-invalid' : '' }}"
                                             id="penulis"
                                             name="penulis"
                                             aria-describedby="penulisHelp"
                                             placeholder="doraemon"
                                             required
                                      >
                                      @if($errors->has('penulis'))
                                          <div class="invalid-feedback">
                                              {{ $errors->first('penulis') }}
                                          </div>
                                      @endif
                                  </div>
                                  <div class="form-group col-4">
                                      <label for="sutradara">{{trans('cruds.film.fields.sutradara')}}</label>
                                      <input type="text"
                                             value="{{ old('sutradara', '') }}"
                                             class="form-control {{ $errors->has('sutradara') ? 'is-invalid' : '' }}"
                                             id="sutradara"
                                             name="sutradara"
                                             aria-describedby="sutradaraHelp"
                                             placeholder="doraemon"
                                             required
                                      >
                                      @if($errors->has('sutradara'))
                                          <div class="invalid-feedback">
                                              {{ $errors->first('sutradara') }}
                                          </div>
                                      @endif
                                  </div>
                                  <div class="form-group col-4">
                                      <label for="produser">{{trans('cruds.film.fields.produser')}}</label>
                                      <input type="text"
                                             value="{{ old('produser', '') }}"
                                             class="form-control {{ $errors->has('produser') ? 'is-invalid' : '' }}"
                                             id="produser"
                                             name="produser"
                                             aria-describedby="produserHelp"
                                             placeholder="doraemon"
                                             required
                                      >
                                      @if($errors->has('produser'))
                                          <div class="invalid-feedback">
                                              {{ $errors->first('produser') }}
                                          </div>
                                      @endif
                                  </div>
                              </div>
                               <div class="row">
                                  <div class="form-group col-6">
                                      <label for="url_film">{{trans('cruds.film.fields.url_film')}}</label>
                                      <input type="text"
                                             value="{{ old('url_film', '') }}"
                                             class="form-control {{ $errors->has('url_film') ? 'is-invalid' : '' }}"
                                             id="url_film"
                                             name="url_film"
                                             aria-describedby="url_filmHelp"
                                             placeholder="url_film"
                                             required
                                      >
                                      @if($errors->has('url_film'))
                                          <div class="invalid-feedback">
                                              {{ $errors->first('url_film') }}
                                          </div>
                                      @endif
                                  </div>
                                  <div class="form-group col-6">
                                      <label for="url_trailer">{{trans('cruds.film.fields.url_trailer')}}</label>
                                      <input type="text"
                                             value="{{ old('url_trailer', '') }}"
                                             class="form-control {{ $errors->has('url_trailer') ? 'is-invalid' : '' }}"
                                             id="url_trailer"
                                             name="url_trailer"
                                             aria-describedby="url_trailerHelp"
                                             placeholder="doraemon"
                                             required
                                      >
                                      @if($errors->has('url_trailer'))
                                          <div class="invalid-feedback">
                                              {{ $errors->first('url_trailer') }}
                                          </div>
                                      @endif
                                  </div>
                              </div>
                               <div class="row">
                                   <div class="form-group col">
                                       <label for="desc">{{trans('cruds.film.fields.description')}}</label>
                                       <textarea
                                           name="desc"
                                           id="desc"
                                           cols="30" rows="10"
                                           class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}"
                                           required
                                       >{{ old('desc', '') }}</textarea>

                                       @if($errors->has('desc'))
                                           <div class="invalid-feedback">
                                               {{ $errors->first('desc') }}
                                           </div>
                                       @endif
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col">
                                       <label class="required" for="genre_id">Genre</label>
                                       <div style="padding-bottom: 4px">
                                           <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                           <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                       </div>
                                       <select class="form-control select2 {{ $errors->has('genre_id') ? 'is-invalid' : '' }}" name="genre_id[]" id="genre_id" multiple required>
                                              @foreach($genres as $key => $label)
                                                  <option value="{{ $key }}" {{ in_array($key, old('genre_id', [])) ? 'selected' : '' }}>{{ $label }}</option>
                                              @endforeach
                                       </select>
                                       @if($errors->has('genre_id'))
                                           <div class="invalid-feedback">
                                               {{ $errors->first('genre_id') }}
                                           </div>
                                       @endif
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col">
                                       <label class="required" for="information">Information</label>
                                       <div>
                                           <button type="button" id="add-information-form" class="btn btn-primary">Add</button>
                                       </div>
                                       <table id="information-form">
                                           <thead>
                                           <tr>
                                               <th>Name</th>
                                               <th>Value</th>
                                           </tr>
                                           </thead>
                                           <tbody>
                                           <tr>
                                               <td><input type="text" name="information[1][name]" class="form-control"></td>
                                               <td><input type="text" name="information[1][value]" class="form-control"></td>
                                               <td>
                                                   <button type="button" class="btn btn-danger" onclick="this.parentNode.parentNode.remove(); return refreshIndex()">
                                                       Delete
                                                   </button>
                                               </td>
                                           </tr>
                                           </tbody>
                                       </table>
                                   </div>
                               </div>
{{--                               <div class="row">--}}
{{--                                   <div class="form-group col">--}}
{{--                                       <label for="thumbnail">{{ trans('cruds.category.fields.thumbnail') }}</label>--}}
{{--                                       <div class="needsclick dropzone {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" id="thumbnail-dropzone">--}}
{{--                                       </div>--}}
{{--                                       @if($errors->has('thumbnail'))--}}
{{--                                           <div class="invalid-feedback">--}}
{{--                                               {{ $errors->first('thumbnail') }}--}}
{{--                                           </div>--}}
{{--                                       @endif--}}
{{--                                       <span class="help-block">{{ trans('cruds.category.fields.thumbnail_helper') }}</span>--}}
{{--                                   </div>--}}
{{--                               </div>--}}
                               <div class="mb-3 ml-3">
                                   <button style="width: 130px" type="submit" class="btn btn-success">Simpan</button>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#genre_id').select2({
                tags: true
            })
            $('#add-information-form').click(function(e) {
                const count = $('#information-form tbody tr').length;
                $('#information-form tbody').append(
                    `<tr>
                        <td><input type="text" name="information[${count + 1}][name]" class="form-control"></td>
                        <td><input type="text" name="information[${count + 1}][value]" class="form-control"></td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="this.parentNode.parentNode.remove(); return refreshIndex()">
                                Delete
                            </button>
                        </td>
                    </tr>`
                );
            })
        })

        function refreshIndex () {
            $('#information-form tbody tr').each(function(index) {
                const inputs = $(this).find('input')
                $(inputs[0]).attr('name', `information[${index + 1}][name]`)
                $(inputs[1]).attr('name', `information[${index + 1}][value]`)
            })
        }
    </script>
@endpush

{{--@section('scripts')--}}
{{--    <script>--}}
{{--        Dropzone.options.thumbnailDropzone = {--}}
{{--            url: '{{ route('movie.store') }}',--}}
{{--            maxFilesize: 2, // MB--}}
{{--            acceptedFiles: '.jpeg,.jpg,.png,.gif',--}}
{{--            maxFiles: 1,--}}
{{--            addRemoveLinks: true,--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': "{{ csrf_token() }}"--}}
{{--            },--}}
{{--            params: {--}}
{{--                size: 2,--}}
{{--                width: 4096,--}}
{{--                height: 4096--}}
{{--            },--}}
{{--            success: function (file, response) {--}}
{{--                $('form').find('input[name="thumbnail"]').remove()--}}
{{--                $('form').append('<input type="hidden" name="thumbnail" value="' + response.name + '">')--}}
{{--            },--}}
{{--            removedfile: function (file) {--}}
{{--                file.previewElement.remove()--}}
{{--                if (file.status !== 'error') {--}}
{{--                    $('form').find('input[name="thumbnail"]').remove()--}}
{{--                    this.options.maxFiles = this.options.maxFiles + 1--}}
{{--                }--}}
{{--            },--}}
{{--            init: function () {--}}
{{--                @if(isset($category) && $category->thumbnail)--}}
{{--                var file = {!! json_encode($category->thumbnail) !!}--}}
{{--                this.options.addedfile.call(this, file)--}}
{{--                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)--}}
{{--                file.previewElement.classList.add('dz-complete')--}}
{{--                $('form').append('<input type="hidden" name="thumbnail" value="' + file.file_name + '">')--}}
{{--                this.options.maxFiles = this.options.maxFiles - 1--}}
{{--                @endif--}}
{{--            },--}}
{{--            error: function (file, response) {--}}
{{--                if ($.type(response) === 'string') {--}}
{{--                    var message = response //dropzone sends it's own error messages in string--}}
{{--                } else {--}}
{{--                    var message = response.errors.file--}}
{{--                }--}}
{{--                file.previewElement.classList.add('dz-error')--}}
{{--                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')--}}
{{--                _results = []--}}
{{--                for (_i = 0, _len = _ref.length; _i < _len; _i++) {--}}
{{--                    node = _ref[_i]--}}
{{--                    _results.push(node.textContent = message)--}}
{{--                }--}}

{{--                return _results--}}
{{--            }--}}
{{--        }--}}

{{--    </script>--}}
{{--@endsection--}}
