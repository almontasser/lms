@extends('layouts.backend')

@section('content')
    <div class="bg-image bg-image-top" @if ($book_instance->book->thumbnail) style="background-image: url('/uploads/{{ $book_instance->book->thumbnail }}');" @endif>
        <div class="bg-primary-dark-op" style="height: 200px;">
        </div>
    </div>

    <div class="content">
        {{-- Quick Actions --}}
        <div class="row">
            @if ($book_instance->status == 'available')
                <div class="col">
                    <div class="block block-rounded block-link-shadow text-center">
                        <a class="block block-rounded block-link-shadow text-center" href="javascript:showMemberModal();">
                            <div class="block-content block-content-full">
                                <div class="font-size-h2 text-primary">
                                    <i class="fa fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="block-content py-2 bg-body-light">
                                <p class="font-w600 font-size-sm text-primary mb-0">
                                    إعارة
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @elseif($book_instance->status == 'loaned')
                <div class="col">
                    <div class="block block-rounded block-link-shadow text-center">
                        <a class="block block-rounded block-link-shadow text-center" href="javascript:$('#modal-return-book').modal('show');">
                            <div class="block-content block-content-full">
                                <div class="font-size-h2 text-danger">
                                    <i class="fa fa-exchange-alt"></i>
                                </div>
                            </div>
                            <div class="block-content py-2 bg-body-light">
                                <p class="font-w600 font-size-sm text-danger mb-0">
                                    ترجيع
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="block block-rounded block-link-shadow text-center">
                    <?php
                    $barcode = $book_instance->barcode;
                    $barcodeImage = generateBarcodeImage($barcode);
                    ?>
                    <a class="block block-rounded block-link-shadow text-center" href="javascript:printBarcode(['<?= $barcodeImage ?>'], ['<?= $barcode ?>'])" disabled>
                            <div class="block-content block-content-full">
                                <div class="font-size-h2 text-dark">
                                    <i class="fa fa-barcode"></i>
                                </div>
                            </div>
                            <div class="block-content py-2 bg-body-light">
                                <p class="font-w600 font-size-sm text-muted mb-0">
                                    طباعة باركود
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content text-center">
                    <div class="py-4">
                        <a href="{{ route('book-show', ['book' => $book_instance->book]) }}"><h1 class="font-size-lg mb-0">{{ $book_instance->book->title }}</h1></a>
                        <p class="font-size-sm text-muted mb-0">النسخة رقم {{ $book_instance->instance_number }}</p>
                    </div>
                </div>
                <div class="block-content bg-body-light text-center">
                    <div class="row items-push text-uppercase">
                        <div class="col">
                            <div class="font-w600 text-dark mb-1">الحالة</div>
                            <p class="font-size-h4 text-primary">
                            @if ($book_instance->status == 'available')
                                    متوفر
                            @elseif($book_instance->status == 'loaned')
                                    مستعار
                            @elseif($book_instance->status == 'damaged')
                                    تالف
                            @elseif($book_instance->status == 'missing')
                                    مفقود
                            @endif
                            </p>
                        </div>
                        <div class="col">
                            <div class="font-w600 text-dark mb-1">الإستعارات</div>
                            <p class="font-size-h3 text-primary">{{ $book_instance->movements()->count() }}</p>
                        </div>
                        @if($book_instance->status == 'loaned')
                        <div class="col">
                          <div class="font-w600 text-dark mb-1">المستعير</div>
                          <p class="font-size-h4 text-primary">{{ $book_instance->movements()->orderBy('id', 'DESC')->first()->user->name }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script>
          function showMemberModal() {
            $("#member-input").val("");
            $("#member-name").text("");
            $("#lend").prop("disabled", true);
            $('#modal-member-input').modal('show');
          }

            document.addEventListener("DOMContentLoaded", function (event) {
                $(() => {
                    $('#member-input').keypress(e => {
                        if (e.which === 13) {
                            e.preventDefault()
                            checkMember();
                        }
                    })

                    $('#modal-member-input').on('shown.bs.modal', function (e) {
                        $('#member-input').focus();
                    });
                });
            });

            function checkMember() {
              const id = $("#member-input").val();
              console.log(id);
              $.ajax({
                method: "GET",
                url: "/users/get/" + id
              })
              .done(function(data) {
                if (data) {
                  $("#member-name").text(data.name);
                  $("#lend").prop("disabled", false);
                  $("#lend").focus();
                  $("#member-error").addClass("d-none");
                } else {
                  $("#member-name").text("");
                  $("#lend").prop("disabled", true);
                  $("#member-error").removeClass("d-none");
                }
              })
            }

            function lendBook() {
              const id = $("#member-input").val();
              const _token = $('meta[name="csrf-token"]').attr('content');
              // const book_instance = {{$book_instance->id}};

              $.post('{{route("book-instances-lend", [$book_instance])}}', {
                _token,
                id
              }).done((e) => {
                if (e.success) {
                  One.helpers('notify', {
                    type: 'success',
                    icon: 'fa fa-check mr-1',
                    message: 'تمت عملية الإعارة بنجاح'
                  });
                  setTimeout(() => {
                    window.location = window.location;
                  }, 2000)
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

        <div class="modal" id="modal-member-input" tabindex="-1" role="dialog" aria-labelledby="modal-member-input"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <div class="block block-rounded block-themed block-transparent mb-0">
                  <div class="block-header bg-primary-dark">
                  <h3 class="block-title">إدخال رقم المستعير</h3>
                  <div class="block-options">
                      <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                      <i class="fa fa-fw fa-times"></i>
                      </button>
                  </div>
                  </div>
                  <div class="block-content">
                    <x-form-input field="member-input" title="رقم المستعير"></x-form-input>
                    <p id="member-name" class="py-0"></p>
                    <p id="member-error" class="py-0 text-danger d-none">لا يوجد عضو بهذا الرقم</p>
                  </div>
                  <div class="block-content block-content-full text-right border-top">
                  <button type="button" class="btn btn-primary" onclick="checkMember();">بحث
                  </button>
                  <button id="lend" type="button" disabled class="btn btn-success" onclick="lendBook()">إعارة
                  </button>
                  <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">إغلاق</button>
                  </div>
              </div>
              </div>
          </div>
        </div>

        {{-- book-instances-return --}}
      <x-book-instance-return />
@endsection
