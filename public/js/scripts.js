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
