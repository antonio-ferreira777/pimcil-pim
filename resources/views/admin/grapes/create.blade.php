@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.grape.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.grapes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.grape.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grape.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="synonyms">{{ trans('cruds.grape.fields.synonyms') }}</label>
                <input class="form-control {{ $errors->has('synonyms') ? 'is-invalid' : '' }}" type="text" name="synonyms" id="synonyms" value="{{ old('synonyms', '') }}">
                @if($errors->has('synonyms'))
                    <div class="invalid-feedback">
                        {{ $errors->first('synonyms') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grape.fields.synonyms_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="color">{{ trans('cruds.grape.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" type="text" name="color" id="color" value="{{ old('color', '') }}">
                @if($errors->has('color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grape.fields.color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.grape.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grape.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pictures">{{ trans('cruds.grape.fields.pictures') }}</label>
                <div class="needsclick dropzone {{ $errors->has('pictures') ? 'is-invalid' : '' }}" id="pictures-dropzone">
                </div>
                @if($errors->has('pictures'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pictures') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grape.fields.pictures_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.grape.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grape.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    var uploadedPicturesMap = {}
Dropzone.options.picturesDropzone = {
    url: '{{ route('admin.grapes.storeMedia') }}',
    maxFilesize: 16, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 16,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="pictures[]" value="' + response.name + '">')
      uploadedPicturesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPicturesMap[file.name]
      }
      $('form').find('input[name="pictures[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($grape) && $grape->pictures)
      var files = {!! json_encode($grape->pictures) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="pictures[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection