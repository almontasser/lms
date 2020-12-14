@props(['field', 'title', 'type' => 'text', 'model' => null, 'required' => false, 'set_old_data' => true, 'class' => ''])

<div class="form-group {{$class}}">
    <label for="{{ $field }}">{{ $title }}@if($required) <span class="text-danger">*</span>@endif</label>
    <input type="{{$type}}" class="form-control autocomplete-off @error($field) is-invalid @enderror" id="{{ $field }}"
           name="{{ $field }}" placeholder="{{ $title }}"
           @if($set_old_data) value="{{ old($field, $model ? $model[$field] : '') }}" @endif
           autocomplete="off" readonly>
    @error($field)
    <div id="{{ $field }}-error" class="invalid-feedback animated fadeIn">{{ $message }}</div>
    @enderror
</div>
