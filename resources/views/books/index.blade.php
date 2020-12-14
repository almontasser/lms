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
                    <th>العنوان</th>
                    <th class="d-none d-sm-table-cell">الكاتب</th>
                    <th class="d-none d-sm-table-cell">دار النشر</th>
                    <th class="d-none d-sm-table-cell">رقم الطبعة</th>
                    <th class="d-none d-sm-table-cell">ISBN</th>
                    <th>أوامر</th>
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
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-block>
    </div>
@endsection
