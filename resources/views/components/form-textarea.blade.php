@props(['field', 'title', 'type' => 'text', 'model' => null, 'required' => false, 'set_old_data' => true,
  'class' => ''])

<div class="form-group {{$class}}">
  <label for="{{ $field }}">{{ $title }}@if($required) <span class="text-danger">*</span>@endif</label>
  <textarea name="{{ $field }}" id="{{ $field }}"
    class="form-control autocomplete-off @error($field) is-invalid @enderror" placeholder="{{ $title }}"
    autocomplete="off" readonly cols="30"
    rows="10">@if($set_old_data){{ old($field, $model ? $model[$field] : '') }}@endif</textarea>
  @error($field)
  <div id="{{ $field }}-error" class="invalid-feedback animated fadeIn">{{ $message }}</div>
  @enderror
</div>
