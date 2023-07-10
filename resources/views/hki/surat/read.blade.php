<div class="head">
    <center>
        <div class="col col-md-6">
            <h6>{{$perusahaan->username}}</h6>
            <h6>{{$perusahaan->alamat}}</h6>
            <h6>Telepon : @if($perusahaan->telepon == null) - @else {{$perusahaan->telepon}}@endif
                <br>Fax : @if($perusahaan->fax == null) - @else{{$perusahaan->fax}}@endif
                <br>E-mail :@if($perusahaan->email == null) - @else{{$perusahaan->email}}@endif
            </h6>
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
        <div class="container">
            <table class=" table table-bordered table-striped display nowrap" style="border: 10px">
                <thead class="table-dark">
                    <tr>
                        <th>No part</th>
                        <th>Part Name</th>
                        <th>QTY</th>
                        <th>Unit</th>
                        <th>Tanggal Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail as $item)
                    <tr>
                        <td>{{$item->part_no}}</td>
                        <td>{{$item->part_name}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->unit}}</td>
                        <td>{{$surat->tanggal}}</td>
                    </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
        
    </div>

</div>
