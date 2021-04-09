@extends('layouts.backend')

@section('content')
  <div class="container pt-4">
    <h4>نتائج البحث عن: {{app('request')->input('s')}}</h4>
    @foreach ($results as $result)
      <?php
      $class = class_basename($result['model']);
      if ($class == 'Book') { ?>
        <a class="pt-4 d-block" href="{{ route('book-show', ['book' => $result['model']]) }}">
          <div>
            كتاب: {{$result['model']->title}}
          </div>
          <small>المؤلف: {{$result['model']->author}}</small>
          {{-- <div>Score: {{$result['score']}}</div> --}}
        </a>
      <?php
      } else if ($class == 'ResearchPaper') { ?>
        <a class="pt-4 d-block" href="{{ route('paper-show', ['paper' => $result['model']]) }}">
          <div>
            ورقة بحثية: {{$result['model']->title}}
          </div>
          <small>المؤلف: {{$result['model']->author}}</small>
          {{-- <div>Score: {{$result['score']}}</div> --}}
        </a>
        <?php } ?>
    @endforeach
  </div>
  <div class="py-4 text-center">
    {{$results->links()}}
  </div>

@endsection
