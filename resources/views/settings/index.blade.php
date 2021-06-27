@extends('layouts.backend')

@section('content')

<x-hero title="الإعدادات">
</x-hero>

<!-- Page Content -->
<div class="content">
  <form action="{{ route('settings') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="block block-rounded">
    <div class="block-header">
      <h3 class="block-title">إعدادات الموقع</h3>
    </div>
    <div class="block-content block-content-full">
      <div class="row items-push">
        <div class="col-lg-8 col-xl-5">
          <div class="form-group">
            <label for="app_name">إسم الموقع</label>
            <input type="text" class="form-control" id="app_name" name="app_name"
              value="{{ Setting::get('app_name', '') }}">
          </div>
          <div class="form-group">
            <label for="address">العنوان</label>
            <input type="text" class="form-control" id="address" name="address"
              value="{{ Setting::get('address', '') }}">
          </div>
          <div class="form-group">
            <label for="facebook_page">صفحة الفيسبوك</label>
            <input type="text" class="form-control" id="facebook_page" name="facebook_page"
              value="{{ Setting::get('facebook_page', '') }}">
          </div>
          <div class="form-group">
            <label for="app_logo">الشعار</label>
            <div class="custom-file">
              <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
              <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                id="app_logo" name="app_logo">
              <label class="custom-file-label" for="app_logo">اختر ملف</label>
            </div>
            <?php $logo = Setting::get("app_logo", ""); ?>
            @if($logo)
            <a href="{{ $logo }}" target="_blank">
              <img width="200" class="mt-2" src="{{ $logo }}" alt="">
            </a>
            @endif
          </div>
        </div>
      </div>
      <div class="row items-push">
        <div class="col-lg-7 offset-lg-4">
          <button type="submit" class="btn btn-alt-primary">
            حفظ
          </button>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>
<!-- END Page Content -->

@endsection
