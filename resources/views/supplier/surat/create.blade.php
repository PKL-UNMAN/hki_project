@extends('layouts.templateBaru', ['title' => 'Buat Surat Jalan'])
@section('content')
<div class="container">
    <h1 class="left-align" style="text-align: left;">Buat Surat Jalan</h1>
    <div class="card">
        <div class="xformdm">
            <form id="myForm" enctype="multipart/form-data" action="{{ route('supplier.surat.store') }}" method="POST">
                @csrf
                <div style="text-align: left" class="row">
                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="basic-usage" style="margin-bottom: 5px;">No Po</label>
                            <select class="form-select" id="basic-usage" data-placeholder="Pilih No Po"
                                name="po_number">
                                <option></option>
                                @foreach ($po as $data)
                                <option value="{{ $data->po_number }}">{{ $data->po_number }}</option>
                                @endforeach
                            </select>
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>
                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="password" style="margin-bottom: 5px;">Tanggal Pengiriman </label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
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
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <h4>Silahkan Pilih Part Yang Akan Dikirim</h4>
                    <br>
                    <!-- Tabel pertama -->
                    <table id="data-table" class="display nowrap table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No Part</th>
                                <th>Part Name</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Order Number</th>
                                <th>Aksi</th> <!-- Tambahkan kolom aksi untuk tombol tambah -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan ditambahkan di sini -->
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">
                    <h4>Silahkan ubah Quantity Part Yang Akan Dikirim</h4>
                    <br>
                    <!-- Tabel kedua -->
                    <table id="additional-table" class="display nowrap table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No Part</th>
                                <th>Part Name</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Order Number</th>
                                <th>Aksi</th>
                                <!-- Tambahkan lebih banyak kolom sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan ditambahkan di sini -->
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
@endsection
@section('script')
<script>
    // Inisialisasi saat halaman dimuat
    $(document).ready(function () {
        // Inisialisasi select2 pada elemen <select> No Po
        $('#basic-usage').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

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
                    url: '/supplier/surat/create/' + selectedPoNumber,
                    method: 'GET',
                    success: function (response) {
                        // Panggil fungsi untuk mengisi opsi setelah menerima data dari server
                        if (response.tujuan !== null) {
                            $('#tujuan').val(response.tujuan.nama);
                        } else {
                            // Membuat pesan dengan menggunakan alert()
                            alert('Opps! Data Po Tidak lengkap');
                        }
                        $('#data-table').DataTable().destroy();
                        // Panggil fungsi untuk mengisi opsi setelah menerima data dari server
                        populateOptions(response);
                        $('#data-table').DataTable({
                            rowReorder: {
                                selector: 'td:nth-child(2)',
                            },
                            responsive: true,
                            stateSave: true,
                            columnDefs: [{
                                searchable: false,
                                orderable: false,
                                targets: 0,
                            }, ],
                            order: [
                                [1, 'asc']
                            ],
                        });
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

        // Tambahkan event listener untuk menangani klik tombol "Pilih"
        $(document).on('click', '.btn-success', function (event) {
            event.preventDefault();
            moveToTable2(this);
            $('#data-table').DataTable().destroy();
            deleteFromTable2(this);
            $('#data-table').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)',
                },
                responsive: true,
                stateSave: true,
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }, ],
                order: [
                    [1, 'asc']
                ],
            });
        });

        // Tambahkan event listener untuk menangani klik tombol "Delete"
        $(document).on('click', '.btn-danger', function (event) {
            event.preventDefault();
            $('#data-table').DataTable().destroy();
            moveToTable1(this);
            $('#data-table').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)',
                },
                responsive: true,
                stateSave: true,
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }, ],
                order: [
                    [1, 'asc']
                ],
            });
        });
    });
    // Fungsi untuk memindahkan data dari tabel kedua ke tabel pertama
    function moveToTable1(button) {
        // Dapatkan baris yang berisi tombol "Delete" yang diklik di tabel kedua
        var row = button.parentNode.parentNode;

        // Dapatkan data dari baris di tabel kedua
        var rowData = {
            no_part: row.cells[0].innerHTML,
            part_name: row.cells[1].innerHTML,
            qty: parseInt(row.cells[2].querySelector('input').getAttribute('max')), // Mengonversi menjadi angka
            unit: row.cells[3].innerHTML,
            order_number: row.cells[4].innerHTML,
        };

        // Dapatkan body tabel pertama
        var tableBodyMain = document.getElementById('data-table').getElementsByTagName('tbody')[0];
        // Buat baris baru di tabel pertama
        var newRowMain = tableBodyMain.insertRow();
        // Masukkan data ke dalam sel-sel baris tabel pertama
        var cellMain_1 = newRowMain.insertCell(0);
        cellMain_1.innerHTML = rowData.no_part;

        var cellMain_2 = newRowMain.insertCell(1);
        cellMain_2.innerHTML = rowData.part_name;

        var cellMain_3 = newRowMain.insertCell(2);
        cellMain_3.innerHTML = rowData.qty;

        var cellMain_4 = newRowMain.insertCell(3);
        cellMain_4.innerHTML = rowData.unit;

        var cellMain_5 = newRowMain.insertCell(4);
        cellMain_5.innerHTML = rowData.order_number;

        // Tambahkan tombol "Delete" untuk menghapus baris dari tabel pertama
        var cellMain_action = newRowMain.insertCell(5);
        cellMain_action.innerHTML = '<button class="btn btn-success">Pilih</button>';

        // Hapus baris dari tabel kedua setelah memindahkan data
        row.remove();
    }
    // Fungsi untuk mengisi Table 1
    function populateOptions(response) {
        var data = response.data;

        // Dapatkan body tabel pertama
        var tableBody1 = document.getElementById('data-table').getElementsByTagName('tbody')[0];

        // Dapatkan body tabel kedua
        var tableBody2 = document.getElementById('additional-table').getElementsByTagName('tbody')[0];

        // Hapus data yang sudah ada dari tabel pertama
        tableBody1.innerHTML = '';

        // Hapus data yang sudah ada dari tabel kedua
        tableBody2.innerHTML = '';

        // Loop melalui data dan buat baris di tabel pertama dan kedua
        for (var i = 0; i < data.length; i++) {
            var rowData = data[i];

            // Buat baris baru di tabel pertama
            var newRow1 = tableBody1.insertRow();

            // Masukkan data ke dalam sel-sel baris tabel pertama
            var cell1_1 = newRow1.insertCell(0);
            cell1_1.innerHTML = rowData.part_no;

            var cell1_2 = newRow1.insertCell(1);
            cell1_2.innerHTML = rowData.part_name;

            var cell1_3 = newRow1.insertCell(2);
            cell1_3.innerHTML = rowData.order_qty;

            var cell1_4 = newRow1.insertCell(3);
            cell1_4.innerHTML = rowData.unit;

            var cell1_5 = newRow1.insertCell(4);
            cell1_5.innerHTML = rowData.order_number;

            // Tambahkan tombol tambah untuk memindahkan data ke tabel kedua
            var cell1_action = newRow1.insertCell(5);
            cell1_action.innerHTML = '<button class="btn btn-success">Pilih</button>';
            // Tambahkan kelas 'data-not-moved' untuk menandai bahwa data belum dipindahkan
            // Tambahkan sel lebih banyak sesuai dengan kolom tambahan pada tabel pertama
        }
    }

    function moveToTable2(button) {
        // Dapatkan baris yang berisi tombol yang diklik
        var row = button.parentNode.parentNode;

        // Dapatkan data dari baris
        var rowData = {
            no_part: row.cells[0].innerHTML,
            part_name: row.cells[1].innerHTML,
            qty: row.cells[2].innerHTML,
            unit: row.cells[3].innerHTML,
            order_number: row.cells[4].innerHTML,
        };

        // Dapatkan body tabel kedua
        var tableBody2 = document.getElementById('additional-table').getElementsByTagName('tbody')[0];

        // Buat baris baru di tabel kedua
        var newRow2 = tableBody2.insertRow();
        // Masukkan data ke dalam sel-sel baris tabel kedua
        var cell2_1 = newRow2.insertCell(0);
        cell2_1.innerHTML = rowData.no_part;

        var cell2_2 = newRow2.insertCell(1);
        cell2_2.innerHTML = rowData.part_name;

        var cell2_3 = newRow2.insertCell(2);
        var maxQuantity = parseInt(rowData.qty);
        cell2_3.innerHTML = rowData.qty; // Ubah kolom "Qty" menjadi input

        var cell2_4 = newRow2.insertCell(3);
        cell2_4.innerHTML = rowData.unit;

        var cell2_5 = newRow2.insertCell(4);
        cell2_5.innerHTML = rowData.order_number;

        // Tambahkan tombol delete untuk menghapus baris dari tabel kedua
        var cell2_action = newRow2.insertCell(5);
        cell2_action.innerHTML = '<button class="btn btn-danger">Delete</button>';
        var inputQty = cell2_3.querySelector('input');
        inputQty.addEventListener('input', function () {
            var enteredValue = parseInt(inputQty.value);
            if (enteredValue > maxQuantity) {
                inputQty.value = maxQuantity; // Reset nilai jika melebihi batas
            }
        });
    }

    function deleteFromTable2(button) {
        // Dapatkan baris yang berisi tombol yang diklik
        var row = button.parentNode.parentNode;

        // Hapus baris dari tabel kedua
        row.remove();
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

<script>
    $(document).ready(function () {
        let t = $('#data-table').DataTable({
            dom: 'lrtip',
            rowReorder: {
                selector: 'td:nth-child(2)',
            },
            responsive: true,
            stateSave: true,
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0,
            }, ],
            order: [
                [1, 'asc']
            ],
        });

        t.on('order.dt search.dt', function () {
            let i = 1;

            t.cells(null, 0, {
                search: 'applied',
                order: 'applied',
            }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    });

    $('#myForm').submit(function (event) {
        event.preventDefault(); // Menghentikan form submission agar bisa diproses dengan JavaScript
        // Ambil data dari tabel dan simpan dalam array
        let tableData = [];
        $('#additional-table tbody tr').each(function (index, row) {
            let $row = $(row);
            let partNo = $row.find('td:nth-child(1)').text();
            let partName = $row.find('td:nth-child(2)').text();
            let qty = $row.find('td:nth-child(3)').text(); // Ambil value dari input pada kolom Qty
            let unit = $row.find('td:nth-child(4)').text();
            let order_number = $row.find('td:nth-child(5)').text();
            // Masukkan data ke dalam array
            tableData.push({
                part_no: partNo,
                part_name: partName,
                qty: qty,
                unit: unit,
                order_number: order_number
            });
        });
        // Lakukan request Ajax ke server untuk menyimpan data
        $.ajax({
            url: "{{ route('supplier.surat.store') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                po_number: $('#basic-usage').val(),
                tanggal: $('#tanggal').val(),
                pengirim: $('input[name="pengirim"]').val(),
                penerima: $('input[name="penerima"]').val(),
                data_table: tableData // Kirim data tabel ke server
            },
            success: function (response) {
                window.location.href = "{{ route('supplier.surat.index') }}";
            },
            error: function (error) {}
        });
    });

</script>
<style>
    /* Warna latar belakang dan teks pada table */
    table.dataTable {
        background-color: #fff;
        /* Latar belakang putih untuk table */
        color: #333;
        /* Warna teks hitam untuk table */
        font-family: 'Roboto', sans-serif;
        /* Atur font menjadi Roboto */
        font-size: 14px;
        /* Atur ukuran font menjadi 14px */
        width: 100%;
        border-collapse: collapse;
    }

    /* Warna latar belakang dan teks pada head table (thead) */
    table.dataTable thead {
        background-color: #007bfff3;
        /* Latar belakang biru sky untuk head table */
        color: #fff;
        /* Warna teks putih untuk head table */
        text-transform: uppercase;
        /* Ubah teks pada head table menjadi huruf kapital */
    }

    /* Warna latar belakang dan teks pada head table yang paling atas */
    table.dataTable thead th:first-child {
        background-color: #007BFF;
        /* Latar belakang biru sky untuk kolom pertama di head table */
        color: #fff;
        /* Warna teks putih untuk kolom pertama di head table */
    }

    /* Warna latar belakang dan teks pada sel (td) */
    table.dataTable tbody td {
        background-color: #eaf3f5;
        /* Warna latar belakang abu-abu muda untuk sel tabel */
        color: #272525;
        /* Warna teks abu-abu untuk sel tabel */
        font-size: 14px
    }

    /* Warna latar belakang setiap baris ganjil pada tabel (tr) */
    table.dataTable tbody tr:nth-of-type(2n+1) td {
        background-color: #ffffff;
        /* Warna latar belakang putih untuk baris ganjil */
    }

    /* Warna teks putih pada tombol aksi dalam tabel */
    table.dataTable tbody button {
        color: #fff;
    }

    .disabled-input {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }

    .btn.btn-success {
        background-color: #007BFF;
        /* Ganti dengan warna biru yang diinginkan */
        color: #fff;
        /* Warna teks putih untuk tombol */
        padding: 8px 16px;
        /* Tambahkan padding pada tombol */
        width: 150px;
        /* Tambahkan lebar pada tombol */
    }

</style>


<style>
    /* Warna latar belakang dan teks pada table */
    table#additional-table {
        background-color: #fff;
        /* Latar belakang putih untuk table */
        color: #333;
        /* Warna teks hitam untuk table */
        font-family: 'Roboto', sans-serif;
        /* Atur font menjadi Roboto */
        font-size: 14px;
        /* Atur ukuran font menjadi 14px */
        width: 100%;
        border-collapse: collapse;
    }

    /* Warna latar belakang dan teks pada head table (thead) */
    table#additional-table thead {
        background-color: #007bfff3;
        /* Latar belakang biru sky untuk head table */
        color: #fff;
        /* Warna teks putih untuk head table */
        text-transform: uppercase;
        /* Ubah teks pada head table menjadi huruf kapital */
    }

    /* Warna latar belakang dan teks pada head table yang paling atas */
    table#additional-table thead th:first-child {
        background-color: #007BFF;
        /* Latar belakang biru sky untuk kolom pertama di head table */
        color: #fff;
        /* Warna teks putih untuk kolom pertama di head table */
    }

    table#additional-table tbody td {
        background-color: #eaf3f5;
        /* Warna latar belakang abu-abu muda untuk sel tabel */
        color: #272525;
        /* Warna teks abu-abu untuk sel tabel */
        font-size: 14px
    }

    table.dataTable tbody tr:nth-of-type(2n+1) td {
        background-color: #ffffff;
        /* Warna latar belakang putih untuk baris ganjil */
    }

    /* Warna teks putih pada tombol aksi dalam tabel */
    table#additional-table tbody button {
        color: #fff;
    }

    .disabled-input {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }


    .btn.btn-danger {
        background-color: #ff0000;
        /* Ganti dengan warna biru yang diinginkan */
        color: #fff;
        /* Warna teks putih untuk tombol */
        padding: 8px 16px;
        /* Tambahkan padding pada tombol */
        width: 150px;
        /* Tambahkan lebar pada tombol */
    }

</style>
@endsection
