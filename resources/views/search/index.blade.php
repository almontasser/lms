@extends('layouts.backend')

@section('content')
  <div class="content pt-4">
    <h4>نتائج البحث عن: {{app('request')->input('s')}}</h4>
    <?php if (count($results) > 0) { ?>
    @foreach ($results as $result)
      <?php
      $class = class_basename($result['model']);
      if ($class == 'Book') { ?>
        <a class="pt-4 d-block" href="{{ route('book-show', ['book' => $result['model']]) }}">
          <div>
            كتاب: {{$result['model']->title}}
          </div>
          <div><small>المؤلف: {{$result['model']->author}}</small></div>
          <?php if (!empty($result['model']->publisher)) { ?>
            <div><small>دار النشر: {{$result['model']->publisher}}</small></div>
          <?php } ?>
          {{-- <div>Score: {{$result['score']}}</div> --}}
        </a>
      <?php
      } else if ($class == 'ResearchPaper') { ?>
        <a class="pt-4 d-block" href="{{ route('paper-show', ['paper' => $result['model']]) }}">
          <div>
            ورقة بحثية: {{$result['model']->title}}
          </div>
          <div><small>المؤلف: {{$result['model']->author}}</small></div>
          {{-- <div>Score: {{$result['score']}}</div> --}}
        </a>
      <?php
      } else if ($class == 'Project') { ?>
      <a class="pt-4 d-block" href="{{ route('project-show', ['project' => $result['model']]) }}">
        <div>
          مشروع: {{$result['model']->title}}
        </div>
        <div><small>المؤلف: {{$result['model']->authors}}</small></div>
        <div><small>المشرف: {{$result['model']->supervisor}}</small></div>
        {{-- <div>Score: {{$result['score']}}</div> --}}
      </a>
      <?php } ?>
    @endforeach
    <?php } else {?>
      <h4>لا يوجد نتائج للبحث</h4>
    <?php } ?>
  </div>
  <div class="py-4 text-center">
    {{$results->links()}}
  </div>

@endsection
