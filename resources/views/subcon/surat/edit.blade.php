{{-- @extends('layouts.templateBaru', ['title' => 'Edit Surat Jalan'])
@section('content') --}}
{{-- <div class="container">
        <div class="card">
            <div class="xformdm">
                <center>
                    <h3>Edit Surat Jalan</h3>
                </center>
                <div class="form mt-4">
                    <form enctype="multipart/form-data" action="{{ route('subcon.surat.update', $surat->id) }}"
                        method="POST">
                        @csrf
                        <div style="text-align: left" class="row">
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="nama_barang">PO Number</label>
                                    <input type="text" class="form-control disabled-input"
                                        id="part_no" name="po_number"
                                        value="{{ $surat->po_number }}" readonly>
                                    @error('part_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
{{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
{{-- </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="password" style="margin-bottom: 5px;">Tanggal Pengiriman </label>
                                    <input type="date" class="form-control" id="Tanggal" name="tanggal" value="{{$surat->tanggal}}" required>
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="password" style="margin-bottom: 5px;">Pengirim</label>
                                    <input type="text" class="form-control disabled-input" value="{{ $surat->pengirim }}" name="pengirim" readonly>
                                </div>
                            </div>
                
                                <div class="col col-md-12 col-12 mt-2">
                                    <div class="form-group">
                                        <label for="tujuan" style="margin-bottom: 5px;">Tujuan Pengiriman</label>
                                        <input type="text" class="form-control disabled-input" id="tujuan" name="penerima"
                                            value="{{$surat->penerima}}" readonly>
                                    </div>
                                </div>
                
                            @foreach ($detail as $index => $item)
                                    <div class="col col-md-12 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="part_no" style="margin-bottom: 5px;">Part No {{ $index + 1}}</label>
                                            <input type="text" class="form-control disabled-input" id="part_no" name="part_no[]" value="{{$item->part_no}}" readonly>
                                        </div>
                                    </div>
                
                                    <div class="col col-md-12 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="nama_barang" style="margin-bottom: 5px;">Part Name {{ $index + 1}}</label>
                                            <input type="text" class="form-control disabled-input"
                                                id="part_name" name="part_name[]" readonly value="{{$item->part_name}}">
                
                                        </div>
                                    </div>
                
                                    <div class="col col-md-12 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="password" style="margin-bottom: 5px;">Order QTY {{ $index + 1}} </label>
                                            <input type="number" class="form-control disabled-input" id="order_qty" name="qty[]" value="{{$item->qty}}" readonly> --}}
{{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
{{-- </div>
                                    </div>
                
                                    <div class="col col-md-12 col-12 mt-2">
                                        <div class="form-group">
                                            <label for="unit" style="margin-bottom: 5px;">Unit (Kg/Pc) {{ $index + 1}} </label>
                                            <input type="text" class="form-control disabled-input" id="unit" name="unit[]" value="{{$item->unit}}" readonly>
                                        </div>
                                    </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div> --}}
{{-- @endsection --}}

@extends('layouts.templateBaru', ['title' => 'Edit Surat Jalan'])
@section('content')
    <div class="container">
        <div class="card">
            <div class="xformdm">
                <h1 class="left-align" style="text-align: left;">Edit Surat Jalan</h1>
                <br>
                <form enctype="multipart/form-data" action="{{ route('subcon.surat.update', $surat->id) }}" method="POST">
                    <!-- Form untuk konten lainnya -->
                    @csrf
                    <div class="table-container">
                        <div class="table-row">
                            <div class="table-cell">
                                <label for="nama_barang">PO Number</label>
                                <input type="text" class="form-control disabled-input" id="part_no" name="po_number"
                                    value="{{ $surat->po_number }}" readonly>
                                @error('part_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="table-cell">
                                <label for="password" style="margin-bottom: 5px;">Tanggal Pengiriman </label>
                                <input type="date" class="form-control" id="Tanggal" name="tanggal"
                                    value="{{ $surat->tanggal }}" required>
                            </div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell">
                                <label for="password" style="margin-bottom: 5px;">Pengirim</label>
                                <input type="text" class="form-control disabled-input" value="{{ $surat->pengirim }}"
                                    name="pengirim" readonly>
                            </div>
                            <div class="table-cell">
                                <label for="tujuan" style="margin-bottom: 5px;">Tujuan Pengiriman</label>
                                <input type="text" class="form-control disabled-input" id="tujuan" name="penerima"
                                    value="{{ $surat->penerima }}" readonly>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-container">
                        <div class="table-row table-header">
                            <div class="table-cell">No Part</div>
                            <div class="table-cell">Part Name</div>
                            <div class="table-cell">Qty</div>
                            <div class="table-cell">Unit</div>
                            <div class="table-cell">Order Number</div>
                        </div>
                        @foreach ($detail as $index => $item)
                            <div class="table-row">
                                <div class="table-cell">
                                    <input type="text" class="form-control disabled-input" id="part_no"
                                        name="part_no[]" value="{{ $item->part_no }}" readonly>
                                </div>
                                <div class="table-cell">
                                    <input type="text" class="form-control disabled-input" id="part_name"
                                        name="part_name[]" readonly value="{{ $item->part_name }}">
                                </div>
                                <div class="table-cell">
                                    <input type="number" class="form-control disabled-input" id="order_qty" name="qty[]"
                                        value="{{ $item->qty }}" readonly>
                                </div>
                                <div class="table-cell">
                                    <input type="text" class="form-control disabled-input" id="unit" name="unit[]"
                                        value="{{ $item->unit }}" readonly>
                                </div>
                                <div class="table-cell">
                                    <input type="text" class="form-control disabled-input" id="unit" name="unit[]"
                                        value="{{ $item->unit }}" readonly>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary custom-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .xformdm {
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .disabled-input {
        background-color: #f7f7f7;
    }

    /* Tampilan table yang menyatu */
    .table-container {
        display: table;
        width: 100%;
        border-collapse: collapse;
    }

    .table-container:hover .table-header {
        background-color: #0056b3;
    }

    .table-row {
        display: table-row;
    }

    .table-cell {
        display: table-cell;
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .table-header {
        background-color: #007BFF;
        font-weight: bold;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    .text-center {
        text-align: center;
    }

    .custom-btn {
        background-color: #007bff;
        color: #fff;
        padding: 40px 80px;
        /* Ubah nilai padding untuk memperbesar tombol */
        font-size: 30px;
        /* Ubah nilai font-size untuk memperbesar teks */
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #0056b3;
        /* Anda juga bisa menambahkan efek transisi atau lainnya saat tombol di-hover */
    }


    .btn-primary {
        background-color: #007bff;
        font-weight: bold;
    }
</style>
