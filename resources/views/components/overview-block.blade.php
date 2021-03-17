@props(['link', ])

<div class="col-6 col-lg-3">
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
