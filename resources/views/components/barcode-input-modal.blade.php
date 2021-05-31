<script>
  document.addEventListener("DOMContentLoaded", function (event) {
        $(() => {
            $('#modal-barcode-input').keypress(e => {
                if (e.which === 13) {
                    e.preventDefault()
                    gotoBarcode($('#barcode-scan-input').val());
                }
            })

            $('#modal-barcode-input').on('shown.bs.modal', function (e) {
                $('#barcode-scan-input').focus();
            });
        });
    });
</script>

<div class="modal" id="modal-barcode-input" tabindex="-1" role="dialog" aria-labelledby="modal-barcode-input"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="block block-rounded block-themed block-transparent mb-0">
        <div class="block-header bg-primary-dark">
          <h3 class="block-title">إدخال باركود</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-fw fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content">
          <x-form-input field="barcode-scan-input" title="باركود"></x-form-input>
        </div>
        <div class="block-content block-content-full text-right border-top">
          <button type="button" class="btn btn-primary" onclick="gotoBarcode()">بحث
          </button>
          <button type="button" class="btn btn-alt-primary mr-1"
            data-dismiss="modal">إغلاق</button>
        </div>
      </div>
    </div>
  </div>
</div>
