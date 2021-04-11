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
<x-hero title="مشاريع التخرج">
  <x-breadcrumb-item title="مشاريع التخرج" link="{{route('projects')}}"></x-breadcrumb-item>
</x-hero>

<div class="content">
  <x-block title="قائمة مشاريع التخرج">
    <table id="projects-table" class="table table-bordered table-striped table-vcenter">
      <thead>
        <tr>
          <th class="text-center" style="width: 80px;">#</th>
          <th class="text-center">العنوان</th>
          <th class="d-none d-sm-table-cell text-center">الكاتب</th>
          <th class="d-none d-sm-table-cell text-center">المشرف</th>
          <th class="d-none d-sm-table-cell text-center">سنة النشر</th>
          <th class="text-center">أوامر</th>
        </tr>
      </thead>
    </table>
    <script>
      document.addEventListener("DOMContentLoaded", function (event) {
        $(document).ready(function() {
          $('#projects-table').DataTable( {
              deferRender: true,
              ajax: '{{route("projects-json")}}',
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
                      $(nTd).html("<a href='/papers/show/"+oData.id+"'>"+oData.title+"</a>");
                    }
                },
                { "data": "authors" },
                { "data": "supervisor" },
                { "data": "year" },
                { "data": "id",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                      $(nTd).html(`
                      <div class="btn-group">
                        <button class="btn btn-sm btn-alt-light"><i class="fa fa-print"></i></button>
                        <a class="btn btn-sm btn-alt-light" href="/projects/edit/${oData.id}"><i
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
