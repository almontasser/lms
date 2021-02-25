@extends('layouts.backend')

@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
<div class="content">
  <!-- Toggle Side Content -->
  <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
  <div class="d-xl-none push">
    <div class="row gutters-tiny">
      <div class="col-6">
        <button type="button" class="btn btn-light btn-block" data-toggle="class-toggle" data-target=".js-ecom-div-nav"
          data-class="d-none">
          <i class="fa fa-fw fa-bars text-muted mr-1"></i> التنقل
        </button>
      </div>

    </div>
  </div>
  <!-- END Toggle Side Content -->
  <div class="row push">
    <div class="col-xl-4 order-xl-1">
      <!-- Categories -->
      <div class="block block-rounded js-ecom-div-nav d-none d-xl-block">
        <div class="block-header block-header-default">
          <h3 class="block-title">
            <i class="fa fa-fw fa-boxes text-muted mr-1"></i> المجال
          </h3>
        </div>
        <div class="block-content">
          <ul class="nav nav-pills flex-column push pr-0">
            @foreach($fields as $field)
            <li class="nav-item mb-1">
              <a class="nav-link d-flex justify-content-between align-items-center"
                href="{{add_query_params(['field' => $field->id])}}">
                {{$field->name}}
                {{--                                    <span class="badge badge-pill badge-secondary ml-1">7k</span>--}}
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      <!-- END Categories -->


    </div>
    <div class="col-xl-8 order-xl-0">
      <!-- Sort and Show Filters -->
      {{--                <div class="d-flex justify-content-between">--}}
      {{--                    <div class="mb-3">--}}
      {{--                        <select id="ecom-results-show" name="ecom-results-show" class="form-control form-control-sm" size="1">--}}
      {{--                            <option value="0" disabled selected>SHOW</option>--}}
      {{--                            <option value="9">9</option>--}}
      {{--                            <option value="18">18</option>--}}
      {{--                            <option value="36">36</option>--}}
      {{--                            <option value="72">72</option>--}}
      {{--                        </select>--}}
      {{--                    </div>--}}
      {{--                    <div class="mb-3">--}}
      {{--                        <select id="ecom-results-sort" name="ecom-results-sort" class="form-control form-control-sm" size="1">--}}
      {{--                            <option value="0" disabled selected>SORT BY</option>--}}
      {{--                            <option value="1">Popularity</option>--}}
      {{--                            <option value="2">Name (A to Z)</option>--}}
      {{--                            <option value="3">Name (Z to A)</option>--}}
      {{--                            <option value="4">Price (Lowest to Highest)</option>--}}
      {{--                            <option value="5">Price (Highest to Lowest)</option>--}}
      {{--                            <option value="6">Sales (Lowest to Highest)</option>--}}
      {{--                            <option value="7">Sales (Highest to Lowest)</option>--}}
      {{--                        </select>--}}
      {{--                    </div>--}}
      {{--                </div>--}}
      <!-- END Sort and Show Filters -->

      <!-- Books -->
      @foreach ($books as $book)
      <div class="block block-rounded pr-0 mb-2" style="height: 98px">
        <a href="{{route('book-show', ['book' => $book])}}">
          <div class="block-content p-0 d-flex" style="overflow: hidden">
            <img class="img-fluid" style="width: 71px; height: 98px; object-fit: cover;" src="{{$book->getCover()}}"
              alt="">
            <div class="py-2 pr-2" style="white-space: nowrap; overflow: hidden;  text-overflow: ellipsis;">
              <p class="h5">{{$book->title}}</p>
              <p class="font-size-sm text-muted mb-0">{{$book->author}}</p>
              <p class="font-size-sm text-muted mb-0">{{$book->print_year}} - الطبعة {{$book->edition}}</p>
            </div>
          </div>
        </a>
      </div>
      @endforeach
      {{$books->links()}}
      <!-- END Books -->
    </div>
  </div>
</div>
@endsection
