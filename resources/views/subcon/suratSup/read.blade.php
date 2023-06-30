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
                <label for="nama_barang">Part No</label>
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
                <label for="nama_barang">Part Name</label>
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
                <label for="password">Order QTY</label>
                <input type="number" class="form-control @error('order_qty') is-invalid @enderror" id="order_qty" name="order_qty" placeholder="Masukkan order_qty" value="{{$surat->order_qty}}" readonly>
                @error('order_qty')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>

        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="password">Weight</label>
                <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" placeholder="Masukkan weight" value="{{$surat->weight}}" readonly>
                @error('weight')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>

        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="password">Order No</label>
                <input type="number" class="form-control @error('order_no') is-invalid @enderror" id="order_no" name="order_no" placeholder="Masukkan order_no" value="{{$surat->order_no}}" readonly>
                @error('order_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>

        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="password">PO Number</label>
                <input type="number" class="form-control @error('po_number') is-invalid @enderror" id="po_number" name="po_number" placeholder="Masukkan po_number" value="{{$surat->po_number}}" readonly>
                @error('po_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>

        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="password">Delivery Time</label>
                <input type="date" class="form-control @error('delivery_time') is-invalid @enderror" id="delivery_time" name="delivery_time" placeholder="Masukkan delivery_time" value="{{$surat->delivery_time}}" readonly>
                @error('delivery_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>

        <div class="col col-md-12 col-12 mt-2">
            <div class="form-group">
                <label for="password">Terms of Payments</label>
                <input type="text" class="form-control @error('payment') is-invalid @enderror" id="payment" name="payment" placeholder="Masukkan payment" value="{{$surat->payment}}" readonly>
                @error('payment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
        </div>




    
    </div>

</div>
