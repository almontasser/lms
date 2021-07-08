@extends('layouts.simple')

@section('content')
<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
  <div class="w-100">
    <!-- Sign In Section -->
    <div class="bg-white">
      <div class="content content-full">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-4 py-4">
            <!-- Header -->
            <div class="text-center">
              <p class="mb-2">
                <img src="{{ Setting::get("app_logo") }}"
                  style="width: 80px; height: 80px; object-fit: contain; display: block; margin: 0 auto;" alt="">
              </p>
              <h1 class="h4 mb-1">
                إنشاء حساب
              </h1>
              <h2 class="h6 font-w400 text-muted mb-3">
                {{ Setting::get("app_name") }}
              </h2>
            </div>
            <!-- END Header -->

            <!-- Sign In Form -->
            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation-signin" action="{{ route('register') }}" method="POST">
              @csrf
              <div class="py-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg form-control-alt" id="name" name="name"
                    placeholder="الإسم" value="{{ old('name') }}">
                  @error('name')
                  <div style="color: red">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg form-control-alt" id="email" name="email"
                    placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                  @error('email')
                  <div style="color: red">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg form-control-alt" id="phone" name="phone"
                    placeholder="رقم الهاتف" value="{{ old('phone') }}">
                  @error('phone')
                  <div style="color: red">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg form-control-alt" id="id_number"
                    name="id_number" placeholder="رقم القيد أو الرقم الوظيفي" value="{{ old('id_number') }}">
                  @error('id_number')
                  <div style="color: red">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg form-control-alt" id="position" name="position"
                    placeholder="الصفة" value="{{ old('position') }}">
                  @error('position')
                  <div style="color: red">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg form-control-alt" id="password"
                    name="password" placeholder="كلمة المرور" value="{{ old('password') }}">
                  @error('password')
                  <div style="color: red">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg form-control-alt"
                    id="password_confirmation" name="password_confirmation" placeholder="تأكيد كلمة المرور">
                  @error('password_confirmation')
                  <div style="color: red">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row justify-content-center mb-0">
                <div class="col-md-7 col-xl-6">
                  <button type="submit" class="btn btn-block btn-success">
                    <i class="fa fa-fw fa-plus mr-1"></i> إنشاء الحساب
                  </button>
                </div>
              </div>
              <div class="row justify-content-center mb-0">
                <div class="py-2">
                  <a class="font-size-sm font-w500" href="{{ route('login') }}">لديك حساب؟ قم بتسجيل
                    الدخول</a>
                </div>
              </div>
            </form>
            <!-- END Sign In Form -->
          </div>
        </div>
      </div>
    </div>
    <!-- END Sign In Section -->

    <!-- Footer -->
    <div class="font-size-sm text-center text-muted py-3">
      <strong>{{ Setting::get("app_name") }}</strong> &copy; <span data-toggle="year-copy"></span>
    </div>
    <!-- END Footer -->
  </div>
</div>
<!-- END Page Content -->
@endsection
