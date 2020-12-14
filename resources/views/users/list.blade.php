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
    <x-hero title="قائمة المستخدمين">
        <x-breadcrumb-item title="المستخدمين" link="{{route('users')}}"></x-breadcrumb-item>
        <x-breadcrumb-item title="قائمة المستخدمين" link="{{route('users-list')}}"></x-breadcrumb-item>
    </x-hero>

    <div class="content">
        <x-block title="قائمة المستخدمين">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>الإسم</th>
                    <th class="d-none d-sm-table-cell">البريد الإلكتروني</th>
                    <th class="d-none d-sm-table-cell">الصفة</th>
                    <th class="d-none d-sm-table-cell">رقم التعريف</th>
                    <th class="d-none d-sm-table-cell">الصلاحية</th>
                    <th>التسجيل</th>
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
                        <td class="d-none d-sm-table-cell">
                            @if ($user->isInactive())
                                <span class="badge badge-warning">غير مفعل</span>
                            @elseif($user->isBanned())
                                <span class="badge badge-danger">محظور</span>
                            @elseif($user->isUser())
                                <span class="badge badge-primary">مستخدم عادي</span>
                            @elseif($user->isAdmin())
                                <span class="badge badge-success">مدير</span>
                            @endif
                        </td>
                        <td>
                            <em class="text-muted">{{ $user->created_at->diffForHumans() }}</em>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-block>
    </div>
@endsection
