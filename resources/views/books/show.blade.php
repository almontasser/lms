@extends('layouts.backend')

@section('css_after')
<link rel="stylesheet" href="{{ asset('/js/plugins/magnific-popup/magnific-popup.css') }}">
@endsection

@section('content')
<div class="bg-image" @if($book->thumbnail) style="background-image: url('/uploads/{{$book->thumbnail}}');" @endif>
  <div class="bg-primary-dark-op" style="height: 200px;">
  </div>
</div>

<div class="content">
  <div class="block block-rounded">
    <div class="block-content">
      <!-- Vitals -->
      <div class="row items-push">
        <div class="col-md-4">
          <!-- Images -->
          <!-- Magnific Popup (.js-gallery class is initialized in Helpers.magnific()) -->
          <!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
          <div class="row gutters-tiny js-gallery img-fluid-100">
            <div class="col-12 mb-3">
              <a class="img-link img-link-zoom-in img-lightbox" href="{{$book->getCover()}}">
                <img class="img-fluid" src="{{$book->getCover()}}" alt="">
              </a>
            </div>
          </div>
          <!-- END Images -->
        </div>
        <div class="col-md-8">
          <div class="d-flex justify-content-between align-items-center border-bottom py-2">
            <div>
              <h1 class="h2 mb-2">{{$book->title}}</h1>
              <h2 class="h4 font-w400 mb-0">{{$book->author}}</h2>
            </div>
            <div>
              <div class="font-size-sm font-w600 text-success text-left">متوفر</div>
              <div class="font-size-sm text-muted text-left">20 نسخة</div>
            </div>
          </div>
          <p class="mt-2">{{$book->description}}</p>
          <!-- END Info -->
        </div>
      </div>
      <!-- END Vitals -->

      <!-- Extra Info Tabs -->
      <!-- Bootstrap Tabs (data-toggle="tabs" is initialized in Helpers.coreBootstrapTabs()) -->
      <div class="block block-rounded">
        <ul class="nav nav-tabs nav-tabs-alt align-items-center pr-0" data-toggle="tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#ecom-product-info">معلومات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#ecom-product-comments">تعليقات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#ecom-product-reviews">مراجعات</a>
          </li>
        </ul>
        <div class="block-content tab-content">
          <!-- Info -->
          <div class="tab-pane pull-x active" id="ecom-product-info" role="tabpanel">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th colspan="2">معلومات عن الكتاب</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="width: 20%;">العنوان</td>
                  <td>
                    {{$book->title}}
                  </td>
                </tr>
                <tr>
                  <td>الكاتب</td>
                  <td>
                    {{$book->author}}
                  </td>
                </tr>
                <tr>
                  <td>دار النشر</td>
                  <td>
                    {{$book->publisher}}
                  </td>
                </tr>
                <tr>
                  <td>الموضوع</td>
                  <td>
                    {{$book->subject}}
                  </td>
                </tr>
                <tr>
                  <td>المجال</td>
                  <td>
                    {{$book->field->name}}
                  </td>
                </tr>
                <tr>
                  <td>التخصص</td>
                  <td>
                    {{$book->specialty->name}}
                  </td>
                </tr>
                <tr>
                  <td>سنة النشر</td>
                  <td>
                    {{$book->print_year}}
                  </td>
                </tr>
                <tr>
                  <td>رقم الطبعة</td>
                  <td>
                    {{$book->edition}}
                  </td>
                </tr>
                <tr>
                  <td>ISBN</td>
                  <td>
                    {{$book->ISBN}}
                  </td>
                </tr>
                <tr>
                  <td>التصنيف</td>
                  <td>
                    {{$book->category}}
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th colspan="2">مكان الكتاب</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="width: 20%;">
                    الصف
                  </td>
                  <td>{{$book->row}}</td>
                </tr>
                <tr>
                  <td>
                    العمود
                  </td>
                  <td>{{$book->col}}</td>
                </tr>
                <tr>
                  <td>
                    الرف
                  </td>
                  <td>
                    {{$book->rack}}
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle;">
                    باركود الكتاب
                  </td>
                  <td>
                    <div class="barcode text-center" style="display: inline-block">
                      <?php
                                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                            $barcode = $book->barcode;
                                            $barcodeImage = base64_encode($generator->getBarcode($barcode, $generator::TYPE_EAN_13, 2, 75));
                                            echo '<img src="data:image/png;base64,' . $barcodeImage . '">';
                                            echo '<p class="text-center mb-0">' . $barcode . '</p>';
                                            ?>
                      <button type="button" class="btn btn-sm btn-primary"
                        onclick="printBarcode('<?= $barcodeImage ?>', '<?= $barcode ?>');">
                        طباعة
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- END Info -->

          <!-- Comments -->
          <div class="tab-pane pull-x font-size-sm" id="ecom-product-comments" role="tabpanel">
            {{-- <div class="media push">
                                <a class="ml-3" href="javascript:void(0)">
                                    <img class="img-avatar img-avatar32" src="/media/avatars/avatar10.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <a class="font-w600" href="javascript:void(0)">محمود المنتصر</a>
                                    <mark class="font-w600 text-danger">مدير</mark>
                                    <p class="my-1">كتاب جيد جدا، ومحتواه رائع!</p>
                                    <a class="ml-1" href="javascript:void(0)">إعجاب</a>
                                    <a class="ml-1" href="javascript:void(0)">رد</a>
                                    <span class="text-muted"><em>منذ 10 دقائق</em></span>
                                    <div class="media mt-3">
                                        <a class="ml-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="/media/avatars/avatar10.jpg"
                                                alt="">
                                        </a>
                                        <div class="media-body">
                                            <a class="font-w600" href="javascript:void(0)">محمد محمد</a>
                                            <p class="my-1">شكرا لك</p>
                                            <a class="ml-1" href="javascript:void(0)">إعجاب</a>
                                            <a class="ml-1" href="javascript:void(0)">رد</a>
                                            <span class="text-muted"><em>منذ 5 دقائق</em></span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
            <div class="pb-2 pr-2">لا يوجد أي تعليقات</div>
            @auth
            <form action="" method="POST">
              <input type="text" class="form-control form-control-alt" name="comment" placeholder="اكتب تعليق...">
            </form>
            @endauth
          </div>
          <!-- END Comments -->

          <!-- Reviews -->
          <div class="tab-pane pull-x font-size-sm" id="ecom-product-reviews" role="tabpanel">
            <!-- Average Rating -->
            <div class="block block-rounded bg-body-light">
              <div class="block-content text-center">
                {{-- Empty Star "far fa-star", Half Star "fa fa-star-half-alt", Full Star "fa fa-star" --}}
                {{-- <p class="text-warning mb-2">
                                        <i class="far fa-star fa-2x"></i>
                                        <i class="far fa-star fa-2x"></i>
                                        <i class="far fa-star fa-2x"></i>
                                        <i class="far fa-star fa-2x"></i>
                                        <i class="far fa-star fa-2x"></i>
                                    </p> --}}
                <div class="rating" data-score="0.5" data-star-on="fa fa-star text-warning"
                  data-star-off="fa fa-star text-muted"></div>
                <p>
                  {{--                                        <strong>3.5</strong>/5.0 من <strong>5</strong> مراجعات--}}
                  لا يوجد مراجعات
                </p>
              </div>
            </div>
            <!-- END Average Rating -->

            <!-- Ratings -->
            {{--                            <div class="media push">--}}
            {{--                                <a class="ml-3" href="javascript:void(0)">--}}
            {{--                                    <img class="img-avatar img-avatar32" src="/media/avatars/avatar10.jpg" alt="">--}}
            {{--                                </a>--}}
            {{--                                <div class="media-body">--}}
            {{--                                    <span class="text-warning">--}}
            {{--                                        <i class="fa fa-star"></i>--}}
            {{--                                        <i class="fa fa-star"></i>--}}
            {{--                                        <i class="fa fa-star"></i>--}}
            {{--                                        <i class="fa fa-star"></i>--}}
            {{--                                        <i class="fa fa-star"></i>--}}
            {{--                                    </span>--}}
            {{--                                    <a class="font-w600" href="javascript:void(0)">محمود المنتصر</a>--}}
            {{--                                    <p class="my-1">كتاب رائع</p>--}}
            {{--                                    <span class="text-muted"><em>منذ 4 ساعات</em></span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            <!-- END Ratings -->
          </div>
          <!-- END Reviews -->
        </div>
      </div>
      <!-- END Extra Info Tabs -->
    </div>
  </div>
</div>
@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{asset('js/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/plugins/raty-js/jquery.raty.js')}}"></script>

<!-- Page JS Helpers (Magnific Popup Plugin) -->
<script>
  jQuery(function () {
            One.helpers('magnific-popup');
        });
</script>
@endsection
