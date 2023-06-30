<div class="head">
    <center>
        <div class="col col-md-6">
            <h6>{{$surat->nama}}</h6>
            <h6>{{$surat->alamat}}</h6>
            <h6>Telepon : @if($surat->telepon == null) - @else {{$surat->telepon}}@endif Fax : @if($surat->fax == null) - @else{{$surat->fax}}@endif</h6>
        </div>
    </center>
  

</div>
<div style="text-align: left" class="row">
    <div class="col col-md-12 col-12 mt-2">
        <div class="form-group">
            <label for="po_number">Po Number</label>
            <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number" name="po_number" placeholder="Masukkan part_no User" value="{{$surat->po_number}}" readonly>
            @error('po_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
    </div>
    <div style="text-align: left" class="row">
        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="Part_no">Part No</label>
                <input type="text" class="form-control @error('part_no') is-invalid @enderror" id="part_no" name="part_no" placeholder="Masukkan part_no User" value="{{$surat->part_no}}" readonly>
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
                <label for="Part_name">Part Name</label>
                <input type="text" class="form-control @error('part_name') is-invalid @enderror" id="part_name" name="part_name" placeholder="Masukkan part_name" value="{{$surat->part_name}}" readonly>
                @error('part_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>
        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="qty">QTY</label>
                <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" placeholder="Masukkan qty" value="{{$surat->qty}}" readonly>
                @error('qty')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>

        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="unit">unit</label>
                <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" placeholder="Masukkan weight" value="{{$surat->unit}}" readonly>
                @error('unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>

        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" placeholder="Masukkan order_no" value="{{$surat->tanggal}}" readonly>
                @error('tanggal')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>
    </div>

</div>
