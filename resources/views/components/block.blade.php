@props(['title', 'subtitle' => null])

<div class="block block-rounded">
  <div class="block-header">
    <h3 class="block-title">{{$title}} @if($subtitle)<small>{{$subtitle}}</small>@endif</h3>
  </div>
  <div class="block-content block-content-full">
    {{$slot}}
  </div>
</div>
