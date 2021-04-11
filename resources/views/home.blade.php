@extends('layouts.backend')

@section('content')

<div class="content">
  <h2 class="text-center">عن ماذا تبحث</h2>
  <form action="{{ route('search') }}" method="GET">
    <div class="form-group">
      <div class="input-group">
          <input type="text" class="form-control border-0" id="home-search" name="s" placeholder="بحث في الكتب والأوراق البحثية ومشاريع التخرج">
          <div class="input-group-append">
              <span class="input-group-text bg-white border-0">
                  <i class="fa fa-search"></i>
              </span>
          </div>
      </div>
  </div>
  </form>
</div>

@endsection
