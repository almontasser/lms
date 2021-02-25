@props(['field', 'title', 'type' => 'text', 'model' => null, 'insert_route', 'options_route', 'get_name_route',
'required' => false, 'class' => ''])

<script>
  document.addEventListener("DOMContentLoaded", function (event) {
    $(() => {
      const _token = $('meta[name="csrf-token"]').attr('content');
      $('#{{ $field  }}').select2({
        theme: 'default no-left-border-radius',
        dir: "rtl",
        lang: 'ar',
        ajax: {
          url: '{{$optionsRoute}}',
          type: 'post',
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token,
              searchTerm: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response.map(f => ({id: f.id, text: f.name}))
            };
          },
          cache: true
        }
      });
      @if(old($field, $model ? $model[$field] : null))
        const id = {{old($field, $model ? $model[$field] : null)}};
      $.post('{{ route($getNameRoute) }}', {
        _token,
        id
      }).done((data) => {
        const option = new Option(data.name, data.id, false, true);
        $('#{{$field}}').append(option).trigger('change');
      });
      @endif

      $('#modal-{{$field}}').keypress(e => {
        if (e.which === 13) {
          e.preventDefault()
          insert_{{$field}}_click();
        }
      })

      $('#modal-{{$field}}').on('shown.bs.modal', function (e) {
        $('#{{$field}}_name').focus();
      });
    });
  });
</script>

<div class="form-group {{$class}}">
  <label for="{{ $field }}">{{ $title }}@if($required) <span class="text-danger">*</span>@endif</label>
  <div class="input-group">
    <select class="js-select2 form-control @error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}"
      data-placeholder="اختار {{ $title }}">
      <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
    </select>
    <div class="input-group-append">
      <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-{{$field}}">+</button>
    </div>
    @error($field)
    <div id="{{ $field }}-error" class="invalid-feedback animated fadeIn">{{ $message }}</div>
    @enderror
  </div>
</div>

{{-- Insert Modal --}}
<div class="modal" id="modal-{{$field}}" tabindex="-1" role="dialog" aria-labelledby="modal-{{$field}}"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="block block-rounded block-themed block-transparent mb-0">
        <div class="block-header bg-primary-dark">
          <h3 class="block-title">إضافة {{$title}}</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-fw fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content">
          <x-form-input field="{{$field}}_name" title="إسم {{$title}}"></x-form-input>
        </div>
        <script>
          function insert_{{$field}}_click() {
            const _token = $('meta[name="csrf-token"]').attr('content');
            const name = $('#{{$field}}_name').val();


            $.post('{{ $insertRoute }}', {
              _token,
              name
            }).done((e) => {
              if (e.success) {
                One.helpers('notify', {
                  type: 'success',
                  icon: 'fa fa-check mr-1',
                  message: 'تمت الإضافة بنجاح'
                });
                $('#modal-{{$field}}').modal('hide');
              } else {
                One.helpers('notify', {
                  type: 'danger',
                  icon: 'fa fa-exclamation mr-1',
                  message: e.error
                });
              }
            }).catch((e) => {
              console.log('ERROR');
            });
          }
        </script>
        <div class="block-content block-content-full text-right border-top">
          <button type="button" class="btn btn-primary" onclick="insert_{{$field}}_click()">إضافة
          </button>
          <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">إغلاق</button>
        </div>
      </div>
    </div>
  </div>
</div>
