@props(['title', 'link' => null])

<li class="breadcrumb-item">
    @if($link)
        <a class="link-fx" href="{{$link}}">
            {{$title}}
        </a>
    @else
        {{$title}}
    @endif
</li>
