@extends('layouts.backend')

@section('content')
<div class="content">
  <h4 style="text-align: center;">الأوراق البحثية</h4>
  <div class="row push">
    <div class="col">

      <!-- Research Papers -->
      @foreach ($papers as $paper)
      <div class="block block-rounded pr-0 mb-2" style="height: 98px">
        <a href="{{route('paper-show', ['paper' => $paper])}}">
          <div class="block-content p-0 d-flex" style="overflow: hidden">
            <img class="img-fluid" style="width: 71px; height: 98px; object-fit: cover;" src="{{$paper->getCover()}}"
              alt="">
            <div class="py-2 px-2" style="white-space: nowrap; overflow: hidden;  text-overflow: ellipsis;">
              <p dir="auto" class="h5" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">{{$paper->title}}</p>
              <p class="font-size-sm text-muted mb-0">{{$paper->author}}</p>
              <p class="font-size-sm text-muted mb-0">{{$paper->year}}</p>
            </div>
          </div>
        </a>
      </div>
      @endforeach
      <div class="pt-4 text-center">
        {{$papers->links()}}
      </div>
      <!-- END Research Papers -->
    </div>
  </div>
</div>
@endsection
