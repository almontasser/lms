@extends('layouts.backend')

@section('css_before')
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/plugins/select2/js/i18n/ar.js') }}"></script>
<script src="{{ asset('js/pages/users_edit_validation.js') }}"></script>
<script>
  $(() => {
    One.helpers(['select2']);
  });
</script>
@endsection

@section('css_after')
<style>
  .select2-container {
    width: calc(100% - 37px) !important;
  }
</style>
@endsection

@section('content')
<x-hero title="{{$edit ? 'تعديل كتاب' : 'إضافة كتاب'}}">
  <x-breadcrumb-item title="الكتب" link="{{route('books')}}"></x-breadcrumb-item>
  <x-breadcrumb-item title="{{$edit ? 'تعديل كتاب' : 'إضافة كتاب'}}"></x-breadcrumb-item>
</x-hero>

<div class="content">
  <x-block title="بيانات الكتاب">
    <form class="js-validation" action="{{$edit ? route('book-edit', ['book' => $book]) : route('books-insert')}}"
      method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <x-form-input field="title" title="العنوان" :model="$book" required="true" class="col-md-6"></x-form-input>
        <x-form-input field="author" title="الكاتب" :model="$book" class="col-md-6"></x-form-input>
      </div>
      <div class="form-row">

        <x-form-input field="publisher" title="دار النشر" :model="$book" class="col-md-6">
        </x-form-input>
        <x-form-input field="subject" title="الموضوع" :model="$book" class="col-md-6"></x-form-input>
      </div>
      <div class="form-row">

        {{--field_id--}}
        <x-form-select2 field="field_id" title="المجال" :model="$book" insert_route="{{route('json-fields-insert')}}"
          options_route="{{ route('json-fields') }}" get_name_route="json-fields-get" class="col-md-6">
        </x-form-select2>
        {{--speciality_id--}}
        <x-form-select2 field="specialty_id" title="التخصص" :model="$book"
          insert_route="{{route('json-specialties-insert')}}" options_route="{{ route('json-specialties') }}"
          get_name_route="json-specialties-get" class="col-md-6"></x-form-select2>
      </div>
      <div class="form-row">
        <x-form-input field="print_year" title="سنة النشر" :model="$book" class="col-md-4">
        </x-form-input>
        <x-form-input field="edition" title="الطبعة" :model="$book" class="col-md-4">
        </x-form-input>
        <x-form-input field="ISBN" title="رقم التعريف الدولي" :model="$book" class="col-md-4">
        </x-form-input>
      </div>
      <div class="form-row">
        <x-form-input field="category" title="التصنيف" :model="$book"  class="col-md-4"></x-form-input>
        {{-- <x-form-input field="price" title="سعر الكتاب" type="number" :model="$book" class="col-md-4"></x-form-input> --}}
        <x-form-input field="registration_number" title="رقم التسجيل" :model="$book" class="col-md-4"></x-form-input>
        {{-- <x-form-input field="lending_days" title="مدة الإعارة (بالأيام)" type="number" :model="$book" class="col-md-4"></x-form-input> --}}
        @if (!$edit) <x-form-input field="copies" title="عدد النسخ" type="number" :model="$book" class="col-md-4"></x-form-input> @endif
      </div>
      <div class="form-row">
        <x-form-input field="row" title="الصف" type="number" :model="$book" class="col-md-4"></x-form-input>
        <x-form-input field="col" title="العمود" type="number" :model="$book" class="col-md-4"></x-form-input>
        <x-form-input field="rack" title="الرف" type="number" :model="$book" class="col-md-4"></x-form-input>
      </div>
      <x-form-input field="notes" title="ملاحظات" :model="$book"></x-form-input>
      <x-form-textarea field="description" title="الوصف" :model="$book"></x-form-textarea>
      <x-form-file-input field="file" title="ملف PDF للكتاب" :model="$book"
        download="{{$edit ? route('book-download', ['book' => $book]) : ''}}"></x-form-file-input>
      <x-form-file-input field="thumbnail" title="غلاف الكتاب" :model="$book" image="true"
        hint="يجب أن لا تزيد أبعاد الصورة عن 1000px في الطول والعرض"></x-form-file-input>
      <button type="submit" class="btn btn-alt-primary">
        @if ($edit) تعديل @else إنشاء @endif
      </button>
    </form>
  </x-block>
</div>

@endsection
