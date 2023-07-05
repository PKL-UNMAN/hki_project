<div class="head">
    <center>
        <div class="col col-md-6">
            <h6>{{$perusahaan->username}}</h6>
            <h6>{{$perusahaan->alamat}}</h6>
            <h6>Telepon : @if($perusahaan->telepon == null) - @else {{$perusahaan->telepon}}@endif
                <br>Fax : @if($perusahaan->fax == null) - @else{{$perusahaan->fax}}@endif</h6>
        </div>
    </center>
  

</div>
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
                <label for="password" style="margin-bottom: 5px;">Tanggal Pengiriman</label>
                <input type="date" class="form-control" id="Tanggal" name="tanggal" value="{{$surat->tanggal}}" readonly>
            </div>
        </div>

        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="password" style="margin-bottom: 5px;">Pengirim</label>
                <input type="text" class="form-control disabled-input" value="{{ $surat->pengirim }}" name="pengirim" readonly>

            </div>

            <div class="col col-md-12 col-12 mt-2">
                <div class="form-group">
                    <label for="tujuan" style="margin-bottom: 5px;">Tujuan Pengiriman</label>
                    <input type="text" class="form-control disabled-input" id="tujuan" name="penerima"
                        value="{{$surat->penerima;}}" readonly>
                </div>

                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="part_no" style="margin-bottom: 5px;">Part No</label>
                        <input type="text" class="form-control disabled-input" id="part_no" name="part_no" value="{{$surat->part_no}}" readonly>
                    </div>
                </div>

                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="nama_barang" style="margin-bottom: 5px;">Part Name</label>
                        <input type="text" class="form-control disabled-input"
                            id="part_name" name="part_name" readonly value="{{$surat->part_name}}">

                    </div>
                </div>

                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="password" style="margin-bottom: 5px;">Order QTY</label>
                        <input type="number" class="form-control disabled-input" id="order_qty" name="qty" value="{{$surat->qty}}" readonly>
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                </div>

                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="unit" style="margin-bottom: 5px;">Unit (Kg/Pc)</label>
                        <input type="text" class="form-control disabled-input" id="unit" name="unit" value="{{$surat->unit}}" readonly>
                    </div>
                </div>
    </div>

</div>
