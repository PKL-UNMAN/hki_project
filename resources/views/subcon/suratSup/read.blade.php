<div class="head">
    <center>
        <div class="col col-md-6">
            <h6>{{$perusahaan->nama}}</h6>
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
                        <th>Order Number</th>
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
                        <td>{{$item->order_number}}</td>
                    </tr>
                    @endforeach
                </tbody>
               
            </table>
            @if ($surat->status == 'On Progress')
                <a href="#" class="btn btn-success" onclick="acc('{{ $surat->id }}')">ACC</a>
            @endif
        </div>
        
    </div>

</div>
<script>
    function acc(id){
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "ACC Surat?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Setuju!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "{{ url('subcon/suratSup/status/ ') }}" + id,
                    success: function (data) {
                        Swal.fire(
                            'Surat Disetujui!',
                            'Status diubah menjadi Finish.',
                            'success',
                            '3000'
                            )
                            location.reload(true);
                        },
                        error: function (xhr, status, error) {
                        Swal.fire(
                            'Kesalahan!',
                            'Terjadi kesalahan dalam memproses permintaan.',
                            'error'
                        )
                    }
                });
            }
        }).catch((error) => {
            Swal.fire(
                'Kesalahan!',
                'Terjadi kesalahan dalam memproses permintaan.',
                'error'
            )
        });
    }
</script>
@section('script')
@endsection