@extends('layouts.backend')

@section('content')
  <div class="container pt-4">
    <h4>نتائج البحث عن: {{app('request')->input('s')}}</h4>
    @foreach ($searchResults as $result)
      <?php if (class_basename($result) == 'Book') { ?>
        <a class="pt-4 d-block" href="{{ route('book-show', ['book' => $result]) }}">
          <div>
            كتاب: {{$result->title}}
          </div>
          <small>المؤلف: {{$result->author}}</small>
        </a>
        <?php } ?>
    @endforeach
  </div>
  <div class="py-4 text-center">
    {{$searchResults->links()}}
  </div>

@endsection
