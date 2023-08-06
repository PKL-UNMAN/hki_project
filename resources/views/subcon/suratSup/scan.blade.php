<div class="head">
</div>
<div style="text-align: left" class="row">
    <div class="col col-md-12 col-12 mt-2">
        <div id="reader" width="600px"></div>
    </div>
</div>

</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
  let no_surat = decodedText;
  //$("#scan").modal('hide');

  // Hentikan kamera setelah pemindaian berhasil
  html5QrcodeScanner.clear();
  // menghilangkan modal scan
  $("#scan").modal('hide');
  // Kirim permintaan AJAX
  $.ajax({
        type: "GET",
        url: '/subcon/suratSup/read/',
        data: {
        additionalData1: no_surat,
        },
        success: function (response) {
          $("#exampleModalCenterTitle").html(`Detail Surat`)
            $("#page").html(response);
            $("#exampleModalCenter").modal('show'); // Tampilkan modal kedua

        },
        error: function (error) {
            // Tangani kesalahan jika terjadi
            console.log("Error:", error);
        }
        });
}

function onScanFailure(error) {
  
}

$(document).ready(function () {
  // Kode Anda untuk menggunakan Html5QrcodeScanner
  html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: { width: 250, height: 250 } },
    /* verbose= */ false
  );
  html5QrcodeScanner.render(onScanSuccess, onScanFailure);
});
</script>