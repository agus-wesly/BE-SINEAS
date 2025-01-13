@extends('layouts.admin')
@section('styles')
    <style>
        /*.select2-container--default .select2-selection--multiple .select2-selection__choice {*/
        /*    background-color: #007bff;*/
        /*    border-color: #007bff;*/
        /*}*/
        img {
            max-width: 500px;
            max-height: 500px;
        }
    </style>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.update') }} {{ trans('cruds.film.title_singular') }}
    </div>

    <div class="card-body">
       <form method="POST" action="{{ route("movie.update", [$film->id]) }}" enctype="multipart/form-data">
           @method('PUT')
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
                                             value="{{ old('title', $film->title) }}"
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
                                             value="{{ old('duration', $film->duration) }}"
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
                                             value="{{ old('date', $film->date) }}"
                                             class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                             id="date"
                                             name="date"
                                             aria-describedby="durationHelp"
                                             required
                                      >
                                      @if($errors->has('date'))
                                          <div class="invalid-feedback">
                                              {{ $errors->first('date') }}
                                          </div>
                                      @endif
                                  </div>
                              </div>
                               <div class="row">
                                  <div class="form-group col-6">
                                      <label for="url_film">{{trans('cruds.film.fields.url_film')}}</label>
                                      <input type="text"
                                             value="{{ old('url_film', $film->url_film) }}"
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
                                             value="{{ old('url_trailer', $film->url_trailer) }}"
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
                                       <label for="thumbnail">Gambar Thumbnail</label>
                                       <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                                   </div>
                                   <div class="form-group col">
                                       <label for="background">Gambar Background</label>
                                       <input type="file" class="form-control" id="background" name="background" accept="image/*">
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col">
                                       @if(count($film->gallery) > 0)
                                            <img src="{{$film->gallery[0]->images}}" id="tampilanGambarThumbnail">
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
                                       >{{ old('desc', $film->desc) }}</textarea>

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
                                                  <option value="{{ $key }}" {{ in_array($key, old('genre_id', $film->filmGenre()->pluck('genre_id')->toArray())) ? 'selected' : '' }}>{{ $label }}</option>
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
                                   <div class="form-group col-6">
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
                                           @foreach($film->information as $key=>$informationItem)
                                               <tr>
                                                   <td><input type="text" name="information[{{ $key }}][name]" class="form-control" value="{{ $informationItem['name'] }}"></td>
                                                   <td><input type="text" name="information[{{ $key }}][value]" class="form-control" value="{{ $informationItem['value'] }}"></td>
                                                   <td>
                                                       <button type="button" class="btn btn-danger" onclick="this.parentNode.parentNode.remove(); return refreshIndex()">
                                                           Delete
                                                       </button>
                                                   </td>
                                               </tr>
                                           @endforeach
                                           </tbody>
                                       </table>
                                   </div>
                                   <div class="form-group col-6">
                                       <label class="required" for="information">Actor</label>
                                       <div>
                                           <button type="button" id="add-actor-form" class="btn btn-primary">Add</button>
                                       </div>
                                       <table id="actor-form">
                                           <thead>
                                           <tr>
                                               <th>Name</th>
                                           </tr>
                                           </thead>
                                           <tbody>
                                           @foreach($film->actors as $key=>$actorItem)
                                               <tr>
                                                   <td><input type="text" name="actor[]" class="form-control" value="{{ $actorItem['name'] }}"></td>
                                                   <td>
                                                       <button type="button" class="btn btn-danger" onclick="this.parentNode.parentNode.remove(); return refreshIndex()">
                                                           Delete
                                                       </button>
                                                   </td>
                                               </tr>
                                           @endforeach

                                           </tbody>
                                       </table>
                                   </div>
                               </div>

                               <div class="mb-3 ml-3">
                                   <button style="width: 130px" type="submit" class="btn btn-success">{{trans('global.update')}}</button>
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

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#thumbnail').change(function() {
                var file = $(this)[0].files[0];
                var fileReader = new FileReader();
                fileReader.onload = function(event) {
                    $('#tampilanGambarThumbnail')
                        .attr('src', event.target.result)
                        .attr('class', 'img-thumbnail rounded');
                };
                fileReader.readAsDataURL(file);
            });

            $('#background').change(function() {
                var file = $(this)[0].files[0];
                var fileReader = new FileReader();
                fileReader.onload = function(event) {
                    $('#tampilanGambarBackground')
                        .attr('src', event.target.result)
                        .attr('class', 'img-thumbnail rounded');
                };
                fileReader.readAsDataURL(file);
            });

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
            $('#add-actor-form').click(function(e) {
                const count = $('#actor-form tbody tr').length;
                $('#actor-form tbody').append(
                    `<tr>
                        <td><input type="text" name="actor[${count + 1}]" class="form-control"></td>
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

            $('#actor-form tbody tr').each(function(index) {
                const inputs = $(this).find('input')
                $(inputs[0]).attr('name', `information[${index + 1}]`)
            })
        }
    </script>
@endsection
