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

<x-hero title="{{$edit ? 'تعديل مستخدم' : 'إضافة مستخدم'}}">
  <x-breadcrumb-item title="المستخدمين" link="{{route('users')}}"></x-breadcrumb-item>
  <x-breadcrumb-item title="{{$edit ? 'تعديل مستخدم' : 'إضافة مستخدم'}}"></x-breadcrumb-item>
</x-hero>

<!-- Page Content -->
<div class="content">
  <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _es6/pages/be_forms_validation.js) -->
  <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
  @if ($edit && $user->type == 4)
  <form class="js-validation" action="{{ route('user-activate', [$user]) }}" method="POST" autocomplete="off">
  @csrf
    <div class="block block-rounded">
      <div class="block-header">
        <h3 class="block-title">بيانات المستخدم</h3>
      </div>
      <div class="block-content block-content-full">
        <div class="row items-push">
          <div class="col-lg-8 col-xl-5">
            <div class="form-group">
              <label for="name">الإسم</label>
              <input type="text" class="form-control" id="name"
                value="{{ $user['name'] }}" autocomplete="off" readonly>
            </div>
            <x-form-input field="email" type="email" required="true" title="البريد الإلكتروني" :model='$user' />
            <x-form-input field="email_confirmation" type="email" required="true" title="تأكيد البريد الإلكتروني" :model='$user' />
          </div>
        </div>
        <div class="row items-push">
          <div class="col-lg-7 offset-lg-4">
            <button type="submit" class="btn btn-alt-primary">
              تفعيل الحساب
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
  @else
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
              <x-form-input field="name" required="true" title="الإسم" :model='$user' />
              <x-form-input field="email" type="email" required="true" title="البريد الإلكتروني" :model='$user' />
              <x-form-input field="phone" required="true" title="رقم الهاتف" :model='$user' />
              <x-form-input field="id_number" required="true" title="رقم القيد أو الرقم الوظيفي" :model='$user' />
              <x-form-input field="position" required="true" title="الصفة" :model='$user' />
              <div class="form-group">
                <label for="type">الصلاحية <span class="text-danger">*</span></label>
                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required="true">
                  <option value="">رجاء اختر الصلاحية</option>
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

    @if($edit)
    <x-block title="أوامر">
      <form class="js-validation" action="{{ route('user-change-password', [$user]) }}" method="POST" autocomplete="off">
        @csrf
        <button type="submit" class="btn btn-alt-primary">
          تغيير كلمة المرور
        </button>
      </form>
    </x-block>
    @endif

  @endif
</div>
<!-- END Page Content -->

@endsection
