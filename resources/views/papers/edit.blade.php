@extends('layouts.backend')

@section('js_after')
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/pages/papers_edit_validation.js') }}"></script>
@endsection

@section('content')
<x-hero title="{{$edit ? 'تعديل ورقة بحثية' : 'إضافة ورقة بحثية'}}">
  <x-breadcrumb-item title="الأوراق البحثية" link="{{route('papers')}}"></x-breadcrumb-item>
  <x-breadcrumb-item title="{{$edit ? 'تعديل ورقة بحثية' : 'إضافة ورقة بحثية'}}"></x-breadcrumb-item>
</x-hero>

<div class="content">
  <x-block title="بيانات الورقة البحثية">
    <form class="js-validation" action="{{$edit ? route('paper-edit', ['paper' => $paper]) : route('paper-insert')}}"
      method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <x-form-input field="title" title="العنوان" :model="$paper" required="true" class="col-md-4"></x-form-input>
        <x-form-input field="author" title="الكاتب" :model="$paper" class="col-md-4"></x-form-input>
        <x-form-input field="year" title="سنة النشر" :model="$paper" class="col-md-4"></x-form-input>
      </div>
      <div class="form-row">
        <x-form-input field="row" title="الصف" type="number" :model="$paper" class="col-md-4"></x-form-input>
        <x-form-input field="col" title="العمود" type="number" :model="$paper" class="col-md-4"></x-form-input>
        <x-form-input field="rack" title="الرف" type="number" :model="$paper" class="col-md-4"></x-form-input>
      </div>
      <x-form-input field="notes" title="ملاحظات" :model="$paper"></x-form-input>
      <x-form-textarea field="abstract" title="الملخص" :model="$paper"></x-form-textarea>
      <x-form-file-input field="file" title="ملف PDF للورقة البحثية" :model="$paper"
        download="{{$edit ? route('paper-download', ['paper' => $paper]) : ''}}"></x-form-file-input>
      <x-form-file-input field="thumbnail" title="غلاف الورقة البحثية" :model="$paper" image="true"
        hint="يجب أن لا تزيد أبعاد الصورة عن 1000px في الطول والعرض"></x-form-file-input>
      <button type="submit" class="btn btn-alt-primary">
        @if ($edit) تعديل @else إنشاء @endif
      </button>
    </form>
  </x-block>
</div>
@endsection
