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

<x-hero title="طلبات التسجيل">
  <x-breadcrumb-item title="المستخدمين" link="{{route('users')}}"></x-breadcrumb-item>
  <x-breadcrumb-item title="طلبات التسجيل" link="{{route('users-registrations')}}"></x-breadcrumb-item>
</x-hero>

<div class="content">
  <x-block title="طلبات التسجيل">
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
      <thead>
        <tr>
          <th class="text-center" style="width: 80px;">#</th>
          <th>الإسم</th>
          <th class="d-none d-sm-table-cell" style="width: 30%;">البريد الإلكتروني</th>
          <th class="d-none d-sm-table-cell">الصفة</th>
          <th class="d-none d-sm-table-cell">رقم التعريف</th>
          <th>التسجيل</th>
          <th class=" text-center" style="width: 100px;">أوامر</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td class="text-center">{{ $user->id }}</td>
          <td class="font-w600">
            <a href="{{ route('users-edit', ['user' => $user]) }}">{{ $user->name }}</a>
          </td>
          <td class="d-none d-sm-table-cell">
            {{ $user->email }}
          </td>
          <td class="d-none d-sm-table-cell">
            {{ $user->position }}
          </td>
          <td class="d-none d-sm-table-cell">
            {{ $user->id_number }}
          </td>
          <td>
            <em class="text-muted">{{ $user->created_at->diffForHumans() }}</em>
          </td>
          <td class="text-center">
            <form action="{{ route('users-registration-actions', ['user' => $user]) }}" method="POST">
              @csrf
              <div class="btn-group">
                <button type="submit" class="btn btn-sm btn-alt-primary js-tooltip-enabled" data-toggle="tooltip"
                  title="" data-original-title="الموافقة" name="action" value="accept">
                  <i class="fa fa-fw fa-check"></i>
                </button>
                <button type="submit" class="btn btn-sm btn-alt-primary js-tooltip-enabled" data-toggle="tooltip"
                  title="" data-original-title="رفض" name="action" value="reject">
                  <i class="fa fa-fw fa-times"></i>
                </button>
              </div>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </x-block>
</div>

@endsection
