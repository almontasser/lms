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

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    بيانات المستخدم @if ($edit)<small
                        class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">المستخدم برقم
                        تعريفي: {{ $user->id_number }}</small>@endif
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">المستخدمين</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">
                                @if ($edit) تعديل بيانات المستخدم @else إنشاء مستخدم
                                @endif
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _es6/pages/be_forms_validation.js) -->
        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
        @if ($edit)
            <form class="js-validation" action="{{ route('users-edit', ['user' => $user]) }}" method="POST"
                  autocomplete="off">
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
                                        <x-form-input field="name" title="الإسم" :model='$user'/>
                                        <x-form-input field="email" title="البريد الإلكتروني" :model='$user'/>
                                        <x-form-input field="id_number" title="رقم القيد أو الرقم الوظيفي"
                                                      :model='$user'/>
                                        <x-form-input field="position" title="الصفة" :model='$user'/>
                                        <div class="form-group">
                                            <label for="type">الصلاحية <span class="text-danger">*</span></label>
                                            <select class="form-control @error('type') is-invalid @enderror" id="type"
                                                    name="type">
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
                                            <div id="type-error"
                                                 class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <x-form-input field="password" title="كلمة المرور"/>
                                        <x-form-input field="password_confirmation" title="تأكيد كلمة المرور"/>
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
