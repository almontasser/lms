@extends('layouts.backend')

@section('js_after')
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/pages/users_edit_validation.js') }}"></script>
@endsection

@section('content')

<?php function checkSelected($field, $value, $user)
    {
        if (old($field, $user ? $user[$field] : null) == $value) {
            echo 'selected';
        }
    } ?>

<x-hero title="{{$edit ? 'تعديل مستخدك' : 'إضافة مستخدم'}}">
  <x-breadcrumb-item title="المستخدمين" link="{{route('users')}}"></x-breadcrumb-item>
  <x-breadcrumb-item title="{{$edit ? 'تعديل مستخدم' : 'إضافة مستخدم'}}"></x-breadcrumb-item>
</x-hero>

<!-- Page Content -->
<div class="content">
  <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _es6/pages/be_forms_validation.js) -->
  <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
  @if ($edit)
  <form class="js-validation" action="{{ route('users-edit', ['user' => $user]) }}" method="POST" autocomplete="off">
    @method('put')
    @else
    <form class="js-validation" action="{{ route('users-insert') }}" method="POST" autocomplete="off">
      @method('post')
      @endif
      @csrf
      <div class="block block-rounded">
        <div class="block-header">
          <h3 class="block-title">بيانات المستخدم</h3>
        </div>
        <div class="block-content block-content-full">
          <div class="row items-push">
            <div class="col-lg-8 col-xl-5">
              <x-form-input field="name" title="الإسم" :model='$user' />
              <x-form-input field="email" title="البريد الإلكتروني" :model='$user' />
              <x-form-input field="id_number" title="رقم القيد أو الرقم الوظيفي" :model='$user' />
              <x-form-input field="position" title="الصفة" :model='$user' />
              <div class="form-group">
                <label for="type">الصلاحية <span class="text-danger">*</span></label>
                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                  <option value="">رجاء اختر الصلاحية</option>
                  <option <?php checkSelected('type', 0, $user); ?> value="0">
                    غير مفعل
                  </option>
                  <option <?php checkSelected('type', 1, $user); ?> value="1">
                    محظور
                  </option>
                  <option <?php checkSelected('type', 2, $user); ?> value="2">
                    مستخدم عادي
                  </option>
                  <option <?php checkSelected('type', 3, $user); ?> value="3">
                    مدير
                  </option>
                </select>
                @error('type')
                <div id="type-error" class="invalid-feedback animated fadeIn">{{ $message }}</div>
                @enderror
              </div>
              <x-form-input field="password" title="كلمة المرور" />
              <x-form-input field="password_confirmation" title="تأكيد كلمة المرور" />
            </div>
          </div>
          <!-- END Regular -->

          <!-- Submit -->
          <div class="row items-push">
            <div class="col-lg-7 offset-lg-4">
              <button type="submit" class="btn btn-alt-primary">
                @if ($edit) تعديل @else إنشاء @endif
              </button>
            </div>
          </div>
          <!-- END Submit -->
        </div>
      </div>
    </form>
    <!-- jQuery Validation -->
</div>
<!-- END Page Content -->

@endsection
