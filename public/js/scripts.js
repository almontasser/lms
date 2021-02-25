$(() => {
    initRating();

    $('.rating').raty({
        click: function(score, evt) {
          alert('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
        }
      });
})

function initRating() {
    // Set Default options
    jQuery.fn.raty.defaults.starType    = 'i';
    jQuery.fn.raty.defaults.hints       = ['Just Bad!', 'Almost There!', 'It’s ok!', 'That’s nice!', 'Incredible!'];

    // Init Raty on .js-rating class
    jQuery('.js-rating').each((index, element) => {
        let el = jQuery(element);

        el.raty({
            score: el.data('score') || 0,
            number: el.data('number') || 5,
            cancel: el.data('cancel') || false,
            target: el.data('target') || false,
            targetScore: el.data('target-score') || false,
            precision: el.data('precision') || false,
            cancelOff: el.data('cancel-off') || 'fa fa-fw fa-times-circle text-danger',
            cancelOn: el.data('cancel-on') || 'fa fa-fw fa-times-circle',
            starHalf: el.data('star-half') || 'fa fa-fw fa-star-half text-warning',
            starOff: el.data('star-off') || 'fa fa-fw fa-star text-muted',
            starOn: el.data('star-on') || 'fa fa-fw fa-star text-warning',
            click: function(score, evt) {
                // Here you could add your logic on rating click
                // console.log('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
            }
        });
    });
}

function printBarcode(base64, barcode) {
    var popupWin = window.open()
    popupWin.document.open()
    popupWin.document.write('<html><head><style>body{margin:0;margin-top:10px}img, p{width: 33mm; text-align:center;margin:0;}p</style></head><body onload="window.print(); setTimeout(window.close, 0);"><img src="data:image/png;base64,' + base64 + '"></img><p>' + barcode + '</p></body></html>');
    popupWin.document.close()
}

let capturing = false
let barcode = ''

function gotoBarcode() {
    window.location.href = '/barcode/' + barcode
}

function resetBarcodeInput() {
    capturing = false
    barcode = ''
}

document.onkeydown=function(e){
    if (e.key === 'F9') {
        e.preventDefault()
        capturing = true
        barcode = ''
        $('#modal-barcode-input').modal('show');
    }

    if (capturing) {
        if ((e.key >= '0') && (e.key <= '9')) {
            e.preventDefault()
            barcode += e.key
            $('#barcode-scan-input').val(barcode)
        } else if (e.key === 'Enter') {
            e.preventDefault()
            capturing = false
            gotoBarcode()
        } else if (e.key === 'Escape') {
            resetBarcodeInput()
        } else {
            e.preventDefault()
        }
    }
}
