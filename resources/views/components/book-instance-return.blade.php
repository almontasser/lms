<script>
  let BookToReturn = null;

  function showReturnBookModal(id) {
    $('#modal-return-book').modal('show');
    BookToReturn = id;
  }

  function returnBook() {
    const _token = $('meta[name="csrf-token"]').attr('content');
    $.post(`/books/instance/${BookToReturn}/return`, {
      _token,
    }).done((e) => {
      if (e.success) {
        One.helpers('notify', {
          type: 'success',
          icon: 'fa fa-check mr-1',
          message: 'تمت عملية الإرجاع بنجاح'
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

<div class="modal" id="modal-return-book" tabindex="-1" role="dialog" aria-labelledby="modal-return-book"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
              <h3 class="block-title">ترجيع الكتاب</h3>
              <div class="block-options">
                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                  <i class="fa fa-fw fa-times"></i>
                </button>
              </div>
            </div>
            <div class="block-content">
              <p id="member-name" class="py-0">هل أنت متأكد من عملية الترجيع؟</p>
            </div>
            <div class="block-content block-content-full text-right border-top">
              <button type="button" class="btn btn-primary" onclick="returnBook();">إرجاع</button>
              <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">إغلاق</button>
              </div>
          </div>
        </div>
    </div>
</div>
