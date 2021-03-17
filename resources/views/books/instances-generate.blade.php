@extends('layouts.backend')

@section('content')
    <div class="content">
        <x-block title="إضافة نسخ" subtitle="{{ $book->title }}">
          <form class="js-validation" action="{{ route('book-instances-generate', ['book' => $book]) }}" method="POST">
            @csrf
            <div class="form-row">
              <x-form-input field="quantity" title="الكمية المراد إضافتها" type="number" :model="$book" required="true" class="col"></x-form-input>
            </div>
            <button type="submit" class="btn btn-alt-primary">
              إضافة
            </button>
          </form>
        </x-block>
    </div>

@endsection
