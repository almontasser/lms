@extends('layouts.backend')

@section('css_before')
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/i18n/ar.js') }}"></script>
<script src="{{ asset('js/pages/projects_edit_validation.js') }}"></script>
@endsection

@section('content')
<x-hero title="{{$edit ? 'تعديل مشروع تخرج' : 'إضافة مشروع تخرج'}}">
  <x-breadcrumb-item title="مشاريع التخرج" link="{{route('projects')}}"></x-breadcrumb-item>
  <x-breadcrumb-item title="{{$edit ? 'تعديل مشروع تخرج' : 'إضافة مشروع تخرج'}}"></x-breadcrumb-item>
</x-hero>

<div class="content">
  <x-block title="بيانات مشروع التخرج">
    <form class="js-validation" action="{{$edit ? route('project-edit', ['project' => $project]) : route('project-insert')}}"
      method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <x-form-input field="title" title="العنوان" :model="$project" required="true" class="col-md-6"></x-form-input>
        <x-form-input field="authors" title="الكاتب" :model="$project" class="col-md-6"></x-form-input>
      </div>
      <div class="form-row">
        <x-form-input field="supervisor" title="المشرف" :model="$project" class="col-md-6"></x-form-input>
        <x-form-input field="sub_supervisor" title="مساعد المشرف" :model="$project" class="col-md-6"></x-form-input>
      </div>
      <div class="form-row">
        <x-form-select2 field="specialty_id" title="التخصص" :model="$project"
          insert_route="{{route('json-specialties-insert')}}" options_route="{{ route('json-specialties') }}"
          get_name_route="json-specialties-get" class="col-md-6"></x-form-select2>
        <x-form-select2 field="stage_id" title="المرحلة" :model="$project" insert_route="{{route('json-stages-insert')}}"
          options_route="{{ route('json-stages') }}" get_name_route="json-stages-get" class="col-md-6">
        </x-form-select2>
      </div>
      <div class="form-row">
        <x-form-input field="semester" title="الفصل الدراسي" :model="$project" class="col-md-6"></x-form-input>
        <x-form-input field="year" title="السنة" :model="$project" class="col-md-6"></x-form-input>
      </div>
      <div class="form-row">
        <x-form-input field="row" title="الصف" type="number" :model="$project" class="col-md-4"></x-form-input>
        <x-form-input field="col" title="العمود" type="number" :model="$project" class="col-md-4"></x-form-input>
        <x-form-input field="rack" title="الرف" type="number" :model="$project" class="col-md-4"></x-form-input>
      </div>
      <x-form-input field="notes" title="ملاحظات" :model="$project"></x-form-input>
      <x-form-textarea field="abstract" title="الملخص" :model="$project"></x-form-textarea>
      <x-form-textarea field="conclusion" title="الخلاصة" :model="$project"></x-form-textarea>
      <x-form-file-input field="file" title="ملف PDF للورقة البحثية" :model="$project"
        download="{{$edit ? route('project-download', ['project' => $project]) : ''}}"></x-form-file-input>
      <x-form-file-input field="thumbnail" title="غلاف مشروع التخرج" :model="$project" image="true"
        hint="يجب أن لا تزيد أبعاد الصورة عن 1000px في الطول والعرض"></x-form-file-input>
      <button type="submit" class="btn btn-alt-primary">
        @if ($edit) تعديل @else إنشاء @endif
      </button>
    </form>
  </x-block>
</div>
@endsection
