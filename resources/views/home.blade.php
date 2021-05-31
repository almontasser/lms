@extends('layouts.backend')

@section('content')

<div class="content">
  <div class="row pb-4">
    <x-overview-block link="{{ route('books-list') }}">
      <x-slot name="content">
        <span class="text-dark">{{ $books_count }}</span>
      </x-slot>
      <x-slot name="title">
        <span class="text-dark">عدد الكتب</span>
      </x-slot>
    </x-overview-block>

    <x-overview-block link="{{ route('projects-list') }}">
      <x-slot name="content">
        <span class="text-dark">{{ $projects_count }}</span>
      </x-slot>
      <x-slot name="title">
        <span class="text-dark">عدد مشاريع التخرج</span>
      </x-slot>
    </x-overview-block>

    <x-overview-block link="{{ route('papers-list') }}">
      <x-slot name="content">
        <span class="text-dark">{{ $papers_count }}</span>
      </x-slot>
      <x-slot name="title">
        <span class="text-dark">عدد الأوراق البحثية</span>
      </x-slot>
    </x-overview-block>

    <x-overview-block link="javascript:void">
      <x-slot name="content">
        <span class="text-dark">3,586,125</span>
      </x-slot>
      <x-slot name="title">
        <span class="text-dark">عدد الزوار</span>
      </x-slot>
    </x-overview-block>
  </div>

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
