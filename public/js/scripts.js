function printBarcode(base64, barcode) {
    var popupWin = window.open()
    popupWin.document.open()
    popupWin.document.write('<html><head><style>body{margin:0;margin-top:10px}img, p{width: 33mm; text-align:center;margin:0;}p</style></head><body onload="window.print(); setTimeout(window.close, 0);"><img src="data:image/png;base64,' + base64 + '"></img><p>' + barcode + '</p></body></html>');
    popupWin.document.close()
}

let capturing = false
let barcode = ''
document.onkeydown=function(e){
    if (e.key === 'F9') {
        e.preventDefault()
        capturing = true
        barcode = ''
    }

    if (capturing && (e.key >= '0') && (e.key <= '9')) {
        e.preventDefault()
        barcode += e.key
    }

    if ((e.key === 'Enter')) {
        e.preventDefault()
        capturing = false
        window.location.href = '/barcode/' + barcode
    }
}
