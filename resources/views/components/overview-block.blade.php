@props(['link', ])

<div class="col-md-4 col-sm-6 col-12">
  <a class="block block-rounded block-link-shadow text-center" href="{{ $link }}">
      <div class="block-content block-content-full">
          <div class="font-size-h2">
              {{ $content }}
          </div>
      </div>
      <div class="block-content py-2 bg-body-light">
          <p class="font-w600 font-size-sm mb-0">
              {{ $title }}
          </p>
      </div>
  </a>
</div>
