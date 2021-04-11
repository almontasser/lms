@extends('layouts.backend')

@section('css_after')
<link rel="stylesheet" href="{{ asset('/js/plugins/magnific-popup/magnific-popup.css') }}">
@endsection

@section('content')
<div class="bg-image bg-image-top" @if($project->thumbnail) style="background-image: url('/uploads/{{$project->thumbnail}}');" @endif>
  <div class="bg-primary-dark-op" style="height: 200px;">
  </div>
</div>

<?php
$barcode = $project->barcode;
$barcodeImage = generateBarcodeImage($barcode);
?>

<div class="content">
  @isAdmin()
  <div class="row">
    <div class="col">
      <div class="block block-rounded block-link-shadow text-center">
          <a class="block block-rounded block-link-shadow text-center" href="{{ route('project-edit', [$project]) }}">
              <div class="block-content block-content-full">
                  <div class="font-size-h2 text-dark">
                      <i class="fa fa-pencil-alt"></i>
                  </div>
              </div>
              <div class="block-content py-2 bg-body-light">
                  <p class="font-w600 font-size-sm text-muted mb-0">
                      تعديل
                  </p>
              </div>
          </a>
      </div>
    </div>
    <div class="col">
      <div class="block block-rounded block-link-shadow text-center">
          <a class="block block-rounded block-link-shadow text-center" href="javascript:printBarcode(['<?= $barcodeImage ?>'], ['<?= $barcode ?>']);">
              <div class="block-content block-content-full">
                  <div class="font-size-h2 text-dark">
                      <i class="fa fa-barcode"></i>
                  </div>
              </div>
              <div class="block-content py-2 bg-body-light">
                  <p class="font-w600 font-size-sm text-muted mb-0">
                      طباعة باركود
                  </p>
              </div>
          </a>
      </div>
    </div>
  </div>
  @endisAdmin()
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
              <a class="img-link img-link-zoom-in img-lightbox" href="{{$project->getCover()}}">
                <img class="img-fluid" src="{{$project->getCover()}}" alt="">
              </a>
            </div>
          </div>
          <!-- END Images -->
        </div>
        <div class="col-md-8">
          <div class="d-flex justify-content-between align-items-center border-bottom py-2">
            <div>
              <h1 class="h2 mb-2">{{$project->title}}</h1>
              <h2 class="h4 font-w400 mb-0">{{$project->authors}}</h2>
            </div>
          </div>
          <p class="mt-2">{{$project->abstract}}</p>
          <!-- END Info -->
        </div>
      </div>
      <!-- END Vitals -->

      <!-- Extra Info Tabs -->
      <!-- Bootstrap Tabs (data-toggle="tabs" is initialized in Helpers.coreBootstrapTabs()) -->
      <div class="block block-rounded">
        <ul class="nav nav-tabs nav-tabs-alt align-items-center pr-0" data-toggle="tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#project-info">معلومات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#project-comments">تعليقات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#project-reviews">مراجعات</a>
          </li>
        </ul>
        <div class="block-content tab-content">
          <!-- Info -->
          <div class="tab-pane pull-x active" id="project-info" role="tabpanel">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th colspan="2">معلومات عن مشروع التخرج</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="width: 20%;">العنوان</td>
                  <td>
                    {{$project->title}}
                  </td>
                </tr>
                <tr>
                  <td>معد المشروع</td>
                  <td>
                    {{$project->authors}}
                  </td>
                </tr>
                <tr>
                  <td>المشرف</td>
                  <td>
                    {{$project->supervisor}}
                  </td>
                </tr>
                <tr>
                  <td>مساعد المشرف</td>
                  <td>
                    {{$project->sub_supervisor}}
                  </td>
                </tr>
                <tr>
                  <td>السنة</td>
                  <td>
                    {{$project->year}}
                  </td>
                </tr>
                <tr>
                  <td>الفصل الدراسي</td>
                  <td>
                    {{$project->semester}}
                  </td>
                </tr>
                <tr>
                  <td>المرحلة</td>
                  <td>
                    {{$project->stage ? $project->stage->name : ''}}
                  </td>
                </tr>
                <tr>
                  <td>التخصص</td>
                  <td>
                    {{$project->specialty ? $project->specialty->name : ''}}
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th colspan="2">مكان الورقة البحثية</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="width: 20%;">
                    الصف
                  </td>
                  <td>{{$project->row}}</td>
                </tr>
                <tr>
                  <td>
                    العمود
                  </td>
                  <td>{{$project->col}}</td>
                </tr>
                <tr>
                  <td>
                    الرف
                  </td>
                  <td>
                    {{$project->rack}}
                  </td>
                </tr>
                @if (Auth::check())
              </tbody>
            </table>
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th colspan="2">المشروع</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="vertical-align: middle;">
                    ملف PDF
                  </td>
                  <td>
                    <?php if (!empty($project->file)) { ?>
                    <a target="__blank" href="{{ route('project-download', ['project' => $project]) }}">فتح ملف PDF</a>
                    <?php } else { ?>
                    لا يوجد ملف
                    <?php } ?>
                  </td>
                </tr>
                @endif
                @isAdmin()
                <tr>
                  <td style="vertical-align: middle;">
                    باركود الورقة البحثية
                  </td>
                  <td>
                    <div class="barcode text-center" style="display: inline-block">
                      <?php
                        echo '<img src="data:image/png;base64,' . $barcodeImage . '">';
                        echo '<p class="text-center mb-0">' . $barcode . '</p>';
                        ?>
                    </div>
                  </td>
                </tr>
                @endisAdmin()
              </tbody>
            </table>
          </div>
          <!-- END Info -->

          <!-- Comments -->
          <div class="tab-pane pull-x font-size-sm" id="project-comments" role="tabpanel">
            <div class="pb-2 pr-2">لا يوجد أي تعليقات</div>
            @auth
            <form action="" method="POST">
              <input type="text" class="form-control form-control-alt" name="comment" placeholder="اكتب تعليق...">
            </form>
            @endauth
          </div>
          <!-- END Comments -->

          <!-- Reviews -->
          <div class="tab-pane pull-x font-size-sm" id="project-reviews" role="tabpanel">
            <!-- Average Rating -->
            <div class="block block-rounded bg-body-light">
              <div class="block-content text-center">
                <div class="rating" data-score="0.5" data-star-on="fa fa-star text-warning"
                  data-star-off="fa fa-star text-muted"></div>
                <p>
                  لا يوجد مراجعات
                </p>
              </div>
            </div>
            <!-- END Average Rating -->

            <!-- Ratings -->

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
