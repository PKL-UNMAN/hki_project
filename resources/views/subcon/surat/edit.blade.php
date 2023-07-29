@extends('layouts.templateBaru', ['title' => 'Edit Surat Jalan'])
@section('content')
    <div class="container">
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
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
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
                                            <input type="number" class="form-control disabled-input" id="order_qty" name="qty[]" value="{{$item->qty}}" readonly>
                                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                        </div>
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
    </div>
@endsection
