@extends('layouts.backend')

@section('content')
<div class="content">
  <div class="row push">
    <div class="col">

      <!-- Projects -->
      @foreach ($projects as $project)
      <div class="block block-rounded pr-0 mb-2" style="height: 98px">
        <a href="{{route('project-show', ['project' => $project])}}">
          <div class="block-content p-0 d-flex" style="overflow: hidden">
            <img class="img-fluid" style="width: 71px; height: 98px; object-fit: cover;" src="{{$project->getCover()}}"
              alt="">
            <div class="py-2 px-2" style="white-space: nowrap; overflow: hidden;  text-overflow: ellipsis;">
              <p dir="ltr" class="h5" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">{{$project->title}}</p>
              <p class="font-size-sm text-muted mb-0">{{$project->authors}}</p>
              <p class="font-size-sm text-muted mb-0">{{$project->year}}</p>
            </div>
          </div>
        </a>
      </div>
      @endforeach
      <div class="pt-4 text-center">
        {{$projects->links()}}
      </div>
      <!-- END Research Papers -->
    </div>
  </div>
</div>
@endsection
