@extends('layouts.templateBaru', ['title' => 'Tambah User'])
@section('content')
<div class="container">
    <h1 class="left-align" style="text-align: left;">Buat Surat Jalan</h1>
    <div class="card">
        <div class="xformdm">
            <form id="myForm" enctype="multipart/form-data" action="{{ route('subcon.surat.store') }}" method="POST">
                @csrf
                <div style="text-align: left" class="row">
                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="basic-usage" style="margin-bottom: 5px;">No Po</label>
                            <select class="form-select" id="basic-usage" data-placeholder="Pilih No Po"
                                name="po_number">
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
                                    value="{{$tujuan[0]->nama;}}" readonly>
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
                    <table id="additional-table" class="display nowrap table table-striped">
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
                    url: '/subcon/surat/create/' + selectedPoNumber,
                    method: 'GET',
                    success: function (response) {
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
        });

        // Tambahkan event listener untuk menangani klik tombol "Delete"
        $(document).on('click', '.btn-danger', function (event) {
            event.preventDefault();
            deleteFromTable2(this);
        });
    });

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
        cell2_3.innerHTML = '<input type="text" value="' + rowData.qty + '">'; // Ubah kolom "Qty" menjadi input

        var cell2_4 = newRow2.insertCell(3);
        cell2_4.innerHTML = rowData.unit;

        var cell2_5 = newRow2.insertCell(4);
        cell2_5.innerHTML = rowData.order_number;

        // Tambahkan tombol delete untuk menghapus baris dari tabel kedua
        var cell2_action = newRow2.insertCell(5);
        cell2_action.innerHTML = '<button class="btn btn-danger">Delete</button>';
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
            let qty = $row.find('td:nth-child(3) input').val(); // Ambil value dari input pada kolom Qty
            let unit = $row.find('td:nth-child(4)').text();

            // Masukkan data ke dalam array
            tableData.push({
                part_no: partNo,
                part_name: partName,
                qty: qty,
                unit: unit
            });
        });
        console.log(tableData);
        // Lakukan request Ajax ke server untuk menyimpan data
        $.ajax({
            url: "{{ route('subcon.surat.store') }}",
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
                window.location.href = "{{ route('subcon.surat.index') }}";
            },
            error: function (error) {

            }
        });
    });
</script>
@endsection