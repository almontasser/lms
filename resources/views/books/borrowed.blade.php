@extends('layouts.backend')

@section('content')
<x-hero title="الكتب المستعارة">
  <x-breadcrumb-item title="الكتب" link="{{route('books')}}"></x-breadcrumb-item>
  <x-breadcrumb-item title="الكتب المستعارة"></x-breadcrumb-item>
</x-hero>

<div class="content">
  <x-block title="الكتب المستعارة">
    <table class="table table-bordered table-striped table-vcenter mt-2">
      <thead>
        <tr>
          <th class="text-center">اسم الكتاب</th>
          <th class="text-center">باركود النسخة</th>
          <th class="text-center">اسم المستعير</th>
          <th class="text-center">تاريخ الإستعارة</th>
          <th class="text-center">تاريخ الترجيع</th>
          <th class="text-center">أوامر</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($movements as $movement)
          <tr>
            <td>
              {{ $movement->book_instance->book->title }}
            </td>
            <td class="text-center">
              {{ $movement->book_instance->barcode }}
            </td>
            <td class="text-center">
              {{ $movement->user->name }}
            </td>
            <td class="text-center">
              {{ $movement->borrow_start }}
            </td>
            <td class="text-center">
              <span class="badge py-2 {{$movement->borrow_end < date('Y-m-d') ? 'badge-danger' : 'badge-success'}}">{{$movement->borrow_end}}</span>
            </td>
            <td class="text-center">
              <div class="btn-group">
                <a class="btn btn-sm btn-alt-light" href="javascript:showReturnBookModal({{ $movement->book_instance->id }})">
                  <i class="fa fa-exchange-alt"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </x-block>
  <x-book-instance-return />
</div>
@endsection
