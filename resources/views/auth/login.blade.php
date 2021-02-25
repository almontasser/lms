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
                <img src="media/cit-logo.png"
                  style="width: 80px; height: 80px; object-fit: contain; display: block; margin: 0 auto;" alt="">
              </p>
              <h1 class="h4 mb-1">
                تسجيل الدخول
              </h1>
              <h2 class="h6 font-w400 text-muted mb-3">
                مكتبة كلية التقنية الصناعية - مصراته
              </h2>
            </div>
            <!-- END Header -->

            <!-- Sign In Form -->
            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
              @csrf
              <div class="py-3">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg form-control-alt" id="email" name="email"
                    placeholder="البريد الإلكتروني">
                  @error('email')
                  <div style="color: red">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg form-control-alt" id="password"
                    name="password" placeholder="كلمة المرور">
                  @error('password')
                  <div style="color: red">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="d-md-flex align-items-md-center justify-content-md-between">
                    <div class="custom-control custom-switch" style="direction: ltr">
                      <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                      <label class="custom-control-label font-w400" for="remember">تذكرني</label>
                    </div>
                    <div class="py-2">
                      <a class="font-size-sm font-w500" href="#">نسيت كلمة
                        المرور؟</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row justify-content-center mb-0">
                <div class="col-md-7 col-xl-6">
                  <button type="submit" class="btn btn-block btn-primary">
                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> تسجيل الدخول
                  </button>
                </div>
              </div>
              <div class="row justify-content-center mb-0">
                <div class="py-2">
                  <a class="font-size-sm font-w500" href="{{ route('register') }}">ليس لديك حساب؟ قم
                    بإنشاءه الآن</a>
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
      <strong>مكتبة كلية التقنية الصناعية مصراته</strong> &copy; <span data-toggle="year-copy"></span>
    </div>
    <!-- END Footer -->
  </div>
</div>
<!-- END Page Content -->
@endsection
