@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.suggestsValue.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.suggests-values.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="suggest_id">{{ trans('cruds.suggestsValue.fields.suggest') }}</label>
                <select class="form-control select2 {{ $errors->has('suggest') ? 'is-invalid' : '' }}" name="suggest_id" id="suggest_id" required>
                    @foreach($suggests as $id => $entry)
                        <option value="{{ $id }}" {{ old('suggest_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('suggest'))
                    <div class="invalid-feedback">
                        {{ $errors->first('suggest') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.suggest_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.suggestsValue.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', '') }}" required>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="language_id">{{ trans('cruds.suggestsValue.fields.language') }}</label>
                <select class="form-control select2 {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language_id" id="language_id" required>
                    @foreach($languages as $id => $entry)
                        <option value="{{ $id }}" {{ old('language_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('language'))
                    <div class="invalid-feedback">
                        {{ $errors->first('language') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country_id">{{ trans('cruds.suggestsValue.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id">
                    @foreach($countries as $id => $entry)
                        <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.suggestsValue.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="picto">{{ trans('cruds.suggestsValue.fields.picto') }}</label>
                <div class="needsclick dropzone {{ $errors->has('picto') ? 'is-invalid' : '' }}" id="picto-dropzone">
                </div>
                @if($errors->has('picto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('picto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.picto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.suggestsValue.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pictures">{{ trans('cruds.suggestsValue.fields.pictures') }}</label>
                <div class="needsclick dropzone {{ $errors->has('pictures') ? 'is-invalid' : '' }}" id="pictures-dropzone">
                </div>
                @if($errors->has('pictures'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pictures') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.pictures_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="table_link">{{ trans('cruds.suggestsValue.fields.table_link') }}</label>
                <input class="form-control {{ $errors->has('table_link') ? 'is-invalid' : '' }}" type="text" name="table_link" id="table_link" value="{{ old('table_link', '') }}">
                @if($errors->has('table_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('table_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.table_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="table_link_value">{{ trans('cruds.suggestsValue.fields.table_link_value') }}</label>
                <input class="form-control {{ $errors->has('table_link_value') ? 'is-invalid' : '' }}" type="number" name="table_link_value" id="table_link_value" value="{{ old('table_link_value', '') }}" step="1">
                @if($errors->has('table_link_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('table_link_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.table_link_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.suggestsValue.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.suggestsValue.fields.status_helper') }}</span>
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
    Dropzone.options.pictoDropzone = {
    url: '{{ route('admin.suggests-values.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="picto"]').remove()
      $('form').append('<input type="hidden" name="picto" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="picto"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($suggestsValue) && $suggestsValue->picto)
      var file = {!! json_encode($suggestsValue->picto) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="picto" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
<script>
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.suggests-values.storeMedia') }}',
    maxFilesize: 12, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 12
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($suggestsValue) && $suggestsValue->files)
          var files =
            {!! json_encode($suggestsValue->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
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
<script>
    var uploadedPicturesMap = {}
Dropzone.options.picturesDropzone = {
    url: '{{ route('admin.suggests-values.storeMedia') }}',
    maxFilesize: 12, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 12,
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
@if(isset($suggestsValue) && $suggestsValue->pictures)
      var files = {!! json_encode($suggestsValue->pictures) !!}
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