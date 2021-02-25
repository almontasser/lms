@extends('layouts.backend')

@section('content')
<x-hero title="الكتب">
  <x-breadcrumb-item title="الكتب" link="{{route('books')}}"></x-breadcrumb-item>
</x-hero>

<div class="content">
  <x-block title="قائمة الكتب">
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
      <thead>
        <tr>
          <th class="text-center" style="width: 80px;">#</th>
          <th class="text-center">العنوان</th>
          <th class="d-none d-sm-table-cell text-center">الكاتب</th>
          <th class="d-none d-sm-table-cell text-center">دار النشر</th>
          <th class="d-none d-sm-table-cell text-center">رقم الطبعة</th>
          <th class="d-none d-sm-table-cell text-center">ISBN</th>
          <th class="text-center">أوامر</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($books as $book)
        <tr>
          <td class="text-center">{{ $book->id }}</td>
          <td class="font-w600">
            <a href="{{ route('book-edit', ['book' => $book]) }}">{{ $book->title }}</a>
          </td>
          <td class="d-none d-sm-table-cell">
            {{ $book->author }}
          </td>
          <td class="d-none d-sm-table-cell">
            {{ $book->publisher }}
          </td>
          <td class="d-none d-sm-table-cell">
            {{ $book->edition }}
          </td>
          <td class="d-none d-sm-table-cell">
            {{ $book->ISBN }}
          </td>
          <td class="text-center">
            <div class="btn-group">
              <button class="btn btn-sm btn-alt-light"><i class="fa fa-print"></i></button>
              <a class="btn btn-sm btn-alt-light" href="{{ route('book-edit', [$book]) }}"><i
                  class="fa fa-fw fa-edit"></i></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </x-block>
</div>
@endsection
