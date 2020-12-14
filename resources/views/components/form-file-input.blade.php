@props(['field', 'title', 'required' => false, 'model' => null, 'image' => false, 'hint' => ''])

<div class="form-group">
    <label>{{$title}}@if($required) <span class="text-danger">*</span>@endif</label>
    <div class="custom-file">
        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
        <input type="file" class="custom-file-input @error($field) is-invalid @enderror" data-toggle="custom-file-input"
               id="{{$field}}" name="{{$field}}">
        <label class="custom-file-label" for="{{$field}}">اختر ملف</label>
        @if($hint)
            <small class="form-text text-muted">
                {{$hint}}
            </small>
        @endif
        @error($field)
        <div id="{{ $field }}-error" class="invalid-feedback animated fadeIn">{{ $message }}</div>
        @enderror
    </div>
    @if($model && $model[$field])
        @if($image)
            <a href="/uploads/{{$model[$field]}}" target="_blank">
                <img class="mt-2" src="/uploads/{{$model[$field]}}" alt="">
            </a>
        @else
            <a class="mt-2 d-block" href="/uploads/{{$model[$field]}}" target="_blank">
                {{$model[$field]}}
            </a>
        @endif
    @endif
</div>
