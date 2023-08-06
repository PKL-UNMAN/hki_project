@extends('layouts.templateBaru', ['title' => 'Update Part'])
@section('content')
<div class="container">
    <h1 class="left-align" style="text-align: left;">Update Part</h1>
    <p class="left-align" style="text-align: left;">Dashboard>Data Master>Update Part</p>
    <div class="card">
        <div class="xformdm">
            <div class="form mt-4">
                <form enctype="multipart/form-data" action="{{ route('hki.part.update', $part->id_part) }}" method="POST">
                    @csrf
                    <div style="text-align: left" class="row">
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="level" style="margin-bottom: 10px;">Produser</label>
                                    <select name="id_user" class="form-control @error('role_id') is-invalid @enderror">
                                        <option value="{{$part->id}}">{{$part->nama}}</option>
                                        @foreach ($produser as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Part No</label>
                                    <input type="text" class="form-control @error('#') is-invalid @enderror" id="#"
                                        name="part_no" placeholder="Masukkan Part No" value="{{$part->part_no}}">
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Part Name</label>
                                    <input type="text" class="form-control @error('#') is-invalid @enderror" id="#"
                                        name="part_name" placeholder="Masukkan Part Name"value="{{$part->part_name}}">
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Composition</label>
                                    <input type="number" step="0.00001" class="form-control @error('#') is-invalid @enderror" id="#"
                                        name="composition" placeholder="Masukkan Composition" value="{{$part->composition}}">
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-4">
                                <div class="form-group">
                                    <label for="#" style="margin-bottom: 10px;">Unit Price</label>
                                    <input type="number" class="form-control @error('#') is-invalid @enderror" id="#"
                                        name="unit_price" placeholder="Masukkan Unit Price"value="{{$part->unit_price}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-warning cancel-button" onclick="showDeleteConfirmation()"
                            style="color: white">Cancel</button>
                        <button type="submit" class="btn btn-primary submit-button">Update Data</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
<script>
    function showDeleteConfirmation() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Untuk membatalkan tindakan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('hki.part.index') }}";
            }
        });
    }
</script>
<style>
    .cancel-button {
        margin-right: 10px;
        /* Tambahkan jarak margin ke kanan */
    }

    /* Atau jika Anda ingin memberi jarak ke kedua sisi tombol */
    .submit-button {
        margin-left: 10px;
    }
</style>
