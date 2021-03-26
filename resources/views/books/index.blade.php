@extends('layouts.backend')

@section('css_before')
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
<x-hero title="الكتب">
  <x-breadcrumb-item title="الكتب" link="{{route('books')}}"></x-breadcrumb-item>
</x-hero>

<div class="content">
  <x-block title="قائمة الكتب">
    <table id="books-table" class="table table-bordered table-striped table-vcenter">
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
      {{-- <tbody>
        @foreach ($books as $book)
        <tr>
          <td class="text-center">{{ $book->id }}</td>
          <td class="font-w600">
            <a href="{{ route('book-show', ['book' => $book]) }}">{{ $book->title }}</a>
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
              <a class="btn btn-sm btn-alt-light" href="{{ route('book-instances', [$book]) }}"><i
                class="fa fa-fw fa-barcode"></i></a>
              <a class="btn btn-sm btn-alt-light" href="{{ route('book-edit', [$book]) }}"><i
                  class="fa fa-fw fa-edit"></i></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody> --}}
    </table>
    <script>
      document.addEventListener("DOMContentLoaded", function (event) {
        $(document).ready(function() {
          $('#books-table').DataTable( {
              "ajax": '{{route("books-json")}}',
              pageLength: 20,
              lengthMenu: [
                  [5, 10, 15, 20],
                  [5, 10, 15, 20]
              ],
              autoWidth: false,
              oLanguage: {
                  sUrl: "/media/lang/jq_datatables_ar.json"
              },
              "columns": [
                { "data": "id" },
                { "data": "title",
                  "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                      $(nTd).html("<a href='/books/show/"+oData.id+"'>"+oData.title+"</a>");
                    }
                },
                { "data": "author" },
                { "data": "publisher" },
                { "data": "edition" },
                { "data": "ISBN" },
                { "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                      $(nTd).html(`
                      <div class="btn-group">
                        <button class="btn btn-sm btn-alt-light"><i class="fa fa-print"></i></button>
                        <a class="btn btn-sm btn-alt-light" href="/books/${oData.id}/instances"><i
                          class="fa fa-fw fa-barcode"></i></a>
                        <a class="btn btn-sm btn-alt-light" href="/books/edit/${oData.id}"><i
                            class="fa fa-fw fa-edit"></i></a>
                      </div>
                      `);
                    }
                },
            ]
          });
        });
      });
    </script>
  </x-block>
</div>
@endsection
