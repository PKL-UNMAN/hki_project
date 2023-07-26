<div class="form mt-4">
    <form id="myForm" enctype="multipart/form-data" action="{{ route('subcon.surat.store') }}" method="POST">
        @csrf
        <div style="text-align: left" class="row">
            <div class="col col-md-12 col-12 mt-2">
                <div class="form-group">
                    <label for="basic-usage" style="margin-bottom: 5px;">No Po</label>
                    <select class="form-select" id="basic-usage" data-placeholder="Pilih No Po" name="po_number">
                        <option></option>
                        @foreach ($po as $data)
                        <option value="{{$data->po_number}}">{{$data->po_number}}</option>
                        @endforeach
                    </select>
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
            </div>
            <div class="col col-md-12 col-12 mt-2">
                <div class="form-group">
                    <label for="password" style="margin-bottom: 5px;">Tanggal Pengiriman </label>
                    <input type="date" class="form-control" id="Tanggal" name="tanggal" required>
                </div>
            </div>

            <div class="col col-md-12 col-12 mt-2">
                <div class="form-group">
                    <label for="password" style="margin-bottom: 5px;">Pengirim</label>
                    <input type="text" class="form-control disabled-input" value="{{ Auth::user()->nama }}"
                        name="pengirim" readonly>

                </div>

                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="tujuan" style="margin-bottom: 5px;">Tujuan Pengiriman</label>
                        <input type="text" class="form-control disabled-input" id="tujuan" name="penerima"
                            value="{{$tujuan[0]->nama;}}" readonly>
                    </div>
                </div>
                {{-- <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group" id="dynamicInputsContainer">

                    </div>
                </div> --}}
                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="part_no" style="margin-bottom: 5px;">Part No</label>
                        <select class="form-select" data-placeholder="Pilih No Part" name="part_no" id="part_no" disabled>
                            <option></option>
                        </select>
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                </div>
                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="part_name" style="margin-bottom: 5px;">Part Name</label>
                        <input type="text" class="form-control" id="part_name" name="part_name" readonly>
                    </div>
                </div>
                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="qty" style="margin-bottom: 5px;">Qty</label>
                        <input type="text" class="form-control" id="qty" name="qty">
                    </div>
                </div>
                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="unit" style="margin-bottom: 5px;">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" readonly>
                    </div>
                </div>
                {{-- untuk multiple input --}}
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-success" id="btnTambah">Tambah Part</button>
                </div>                
                <div id="dataContainer" class="mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Part No</th>
                                <th>Part Name</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dataTableBody">
                
                        </tbody>
                    </table>
                </div>
                
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
    </form>
</div>

{{-- <script>
    $(document).ready(function() {
        $("#order_qty,#weight").keyup(function() {
            let qty = $("#order_qty").val();
            let weigth = qty;
            console.log(qty)
            $("#weight").val(`${qty}`);
        });
    })
</script> --}}

<style>
    /* Warna label/kolom saat normal */
    .form-group label,
    .form-control {
        background-color: #fff;
    }

    /* Warna label/kolom ketika disentuh */
    .form-group label:hover,
    .form-control:focus {
        color: #fff;
        background-color: #888;
    }

    .disabled-input {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }
</style>
<script>
    // Inisialisasi saat halaman dimuat
    $(document).ready(function () {
        // Inisialisasi select2 pada elemen <select> No Po
        $('#basic-usage').select2({
            dropdownParent: $('#exampleModalCenter'),
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        // Inisialisasi select2 pada elemen <select> Part No
        $('#part_no').select2({
            dropdownParent: $('#exampleModalCenter'),
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        // Fungsi untuk menangani perubahan pada elemen <select> No Po
        function handlePoNumberChange() {
            // Mendapatkan nilai dari tag <select> No Po
            var selectedPoNumber = $('#basic-usage').val();

            // Mendapatkan elemen <select> Part No
            const selectPartNoElement = $("#part_no");

            // Disable input Part No jika No Po belum dipilih
            if (selectedPoNumber === "") {
                selectPartNoElement.prop("disabled", true);
                // Hapus opsi yang sudah ada pada elemen <select> Part No
                selectPartNoElement.empty();
            } else {
                // Enable input Part No jika No Po dipilih
                selectPartNoElement.prop("disabled", false);

                // Melakukan permintaan AJAX hanya jika No Po sudah dipilih
                $.ajax({
                    url: '/subcon/surat/create/' + selectedPoNumber,
                    method: 'GET',
                    success: function (response) {
                        // Panggil fungsi untuk mengisi opsi setelah menerima data dari server
                        populateOptions(response);
                    },
                    error: function () {
                        console.log('Terjadi kesalahan dalam permintaan AJAX.');
                    }
                });
            }
        }

        // Panggil fungsi handlePoNumberChange untuk mengatur status input Part No saat halaman dimuat
        handlePoNumberChange();

        // Tambahkan event listener untuk menangani perubahan pada elemen <select> No Po
        $('#basic-usage').on('change', function () {
            handlePoNumberChange();
        });

        // Event listener untuk form submission
        $('#myForm').submit(function (event) {
            event.preventDefault(); // Menghentikan form submission agar bisa diproses dengan JavaScript

            // Ambil data dari tabel dan simpan dalam array
            let tableData = [];
            $('#dataTableBody tr').each(function (index, row) {
                let $row = $(row);
                let partNo = $row.find('td:nth-child(2)').text();
                let partName = $row.find('td:nth-child(3)').text();
                let qty = $row.find('td:nth-child(4)').text();
                let unit = $row.find('td:nth-child(5)').text();

                // Masukkan data ke dalam array
                tableData.push({
                    part_no: partNo,
                    part_name: partName,
                    qty: qty,
                    unit: unit
                });
            });
            // Lakukan request Ajax ke server untuk menyimpan data
            $.ajax({
                url: "{{ route('subcon.surat.store') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    po_number: $('#basic-usage').val(),
                    tanggal: $('#Tanggal').val(),
                    pengirim: $('input[name="pengirim"]').val(),
                    penerima: $('input[name="penerima"]').val(),
                    data_table: tableData // Kirim data tabel ke server
                },
                success: function (response) {
                    window.location.href = "{{ route('subcon.surat.index') }}";
                },
                error: function (error) {
                    
                }
            });
        });
    });

    // Fungsi untuk mengisi opsi ke dalam elemen <select> Part No
    function populateOptions(response) {
        // Cari elemen <select> berdasarkan ID
        const selectElement = $("#part_no");

        // Kosongkan elemen <select>
        selectElement.empty();
        // Tambahkan opsi-opsi ke dalam elemen <select>
        response.data.forEach(function (item, index) {
            selectElement.append(`<option value="${item.part_no}">${item.part_no}</option>`);
        });
        // Panggil fungsi partnoChange() secara manual setelah elemen basic-usage terisi
        partnoChange();
    }

    // script untuk mengambil data detail part
$('#part_no').on('change', function () {
    partnoChange();
});

function partnoChange() {
    // Mendapatkan nilai dari tag <select> Part No
    var selectedPartno = $('#part_no').val();
    var selectedPoNumber = $('#basic-usage').val();
    // Gabungkan data tersebut dengan karakter terpisah, misalnya '_'
    var combinedData = selectedPartno + '_' + selectedPoNumber;
    // Melakukan permintaan AJAX
    if (selectedPartno !== "") {
        $.ajax({
            url: '/subcon/surat/create/dPart/' + combinedData,
            method: 'GET',
            success: function (response) {

                if (response !== null) {
                    // Ambil data yang diperlukan dari response
                var partData = response.data[0];
                var partName = partData.part_name;
                var qty = partData.order_qty;
                var unit = partData.unit;

                // Isi nilai pada input part_name, qty, dan unit
                $("#part_name").val(partName);
                $("#qty").val(qty);
                $("#unit").val(unit);
                }
                
            },
            error: function () {
                console.log('Terjadi kesalahan dalam permintaan AJAX.');
            }
        });
    } else {
        // Jika Part No belum dipilih, kosongkan nilai pada input part_name, qty, dan unit
        $("#part_name").val("");
        $("#qty").val("");
        $("#unit").val("");
    }
}

    // Script untuk menambahkan kelas 'active' pada label saat input diberi fokus
    document.addEventListener('DOMContentLoaded', function () {
        let formControls = document.querySelectorAll('.form-control');

        formControls.forEach(function (control) {
            control.addEventListener('focus', function () {
                this.previousElementSibling.classList.add('active');
            });

            control.addEventListener('blur', function () {
                this.previousElementSibling.classList.remove('active');
            });
        });
    });
</script>

{{-- untuk pengisian data table --}}
<script>
    // Inisialisasi data untuk menyimpan item-item yang akan ditambahkan ke dalam tabel
    let tableData = [];

    // Fungsi untuk menambahkan data ke dalam tabel
    function addToTable() {
        let selectedPartno = $('#part_no').val();
        let partName = $('#part_name').val();
        let qty = $('#qty').val();
        let unit = $('#unit').val();

        if (selectedPartno && partName && qty && unit) {
            let row = `
                <tr>
                    <td>${tableData.length + 1}</td>
                    <td>${selectedPartno}</td>
                    <td>${partName}</td>
                    <td>${qty}</td>
                    <td>${unit}</td>
                    <td>
                        <button type="button" class="btn btn-danger btnHapus" data-index="${tableData.length}">
                            Hapus
                        </button>
                    </td>
                </tr>
            `;

            // Tambahkan row ke dalam tabel
            $('#dataTableBody').append(row);

            // Tambahkan data ke dalam array tableData
            tableData.push({
                part_no: selectedPartno,
                part_name: partName,
                qty: qty,
                unit: unit
            });

            // Reset field Part No, Part Name, Qty, dan Unit
            $('#part_no').val('');
            $('#part_name').val('');
            $('#qty').val('');
            $('#unit').val('');
        } else {
            alert('Lengkapi semua field sebelum menambahkan data.');
        }
    }

    // Fungsi untuk menghapus data dari tabel berdasarkan index
    function removeFromTable(index) {
        tableData.splice(index, 1); // Hapus data dari array tableData
        refreshTable(); // Refresh tabel setelah data dihapus
    }

    // Fungsi untuk menyegarkan isi tabel setelah ada perubahan data
    function refreshTable() {
        // Kosongkan isi tabel
        $('#dataTableBody').empty();

        // Tambahkan kembali data dari array tableData ke dalam tabel
        tableData.forEach(function (item, index) {
            let row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.part_no}</td>
                    <td>${item.part_name}</td>
                    <td>${item.qty}</td>
                    <td>${item.unit}</td>
                    <td>
                        <button type="button" class="btn btn-danger btnHapus" data-index="${index}">
                            Hapus
                        </button>
                    </td>
                </tr>
            `;
            $('#dataTableBody').append(row);
        });
    }

    // Event listener untuk tombol "Tambah"
    $('#btnTambah').on('click', function () {
        addToTable();
    });

    // Event listener untuk tombol "Hapus"
    $(document).on('click', '.btnHapus', function () {
        let index = $(this).data('index');
        removeFromTable(index);
    });
</script>
