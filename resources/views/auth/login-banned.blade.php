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
                                        style="width: 80px; height: 80px; object-fit: contain; display: block; margin: 0 auto;"
                                        alt="">
                                </p>
                                <h1 class="h4 mb-1">
                                    إنشاء حساب
                                </h1>
                                <h2 class="h6 font-w400 text-muted mb-3">
                                    مكتبة كلية التقنية الصناعية - مصراته
                                </h2>
                            </div>
                            <!-- END Header -->

                            <div class="text-center py-4" style="font-size: 1.25rem;">لقد تم حظر حسابك. الرجاء
                                التواصل مع المكتبة لحل المشكلة
                            </div>
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
