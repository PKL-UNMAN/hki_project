@extends('layouts.templateBaru', ['title' => 'Edit User'])
@section('content')
<div class="container">
    <div class="card">
        <div class="xformdm">
            <center>
                <h3>Edit User</h3>
            </center>
            <div class="form mt-4">
                <form enctype="multipart/form-data" action="{{ route('hki.user.update', $user->id) }}" method="POST">
                    @csrf
                    <div style="text-align: left" class="row">
                        <div class="col col-md-6 mt-2">
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="nama_barang">Nama User</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" placeholder="Masukkan Nama User" value="{{ $user->nama }}"
                                        readonly>
                                    @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="nama_barang">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" placeholder="Masukkan Username"
                                        value="{{ $user->username }}">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="password">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Masukkan email" value="{{ $user->email }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Masukkan Password"
                                        value="{{ old('password') }}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>

                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="level">Role Name</label>
                                    <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Level Akun --</option>
                                        @foreach ($role as $data)
                                        <option value="{{ $data->role_id }}" @if ($user->role_id == $data->role_id)
                                            selected @endif>
                                            {{ $data->role_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col col-md-6 mt-2">
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="nama_barang">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        id="alamat" name="alamat" placeholder="Masukkan Alamat"
                                        value="{{ $user->alamat }}">
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="nama_barang">Telepon</label>
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                        id="telepon" name="telepon" placeholder="Masukkan telepon"
                                        value="{{ $user->telepon }}">
                                    @error('telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                            <div class="col col-md-12 col-12 mt-2">
                                <div class="form-group">
                                    <label for="nama_barang">Fax</label>
                                    <input type="text" class="form-control @error('fax') is-invalid @enderror" id="fax"
                                        name="fax" placeholder="Masukkan fax" value="{{ $user->fax }}">
                                    @error('fax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                            </div>
                        </div>




                    </div>

                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-warning cancel-button" onclick="showDeleteConfirmation()"
                            style="color: white">Cancel</button>
                        <button type="submit" class="btn btn-primary submit-button">Submit</button>
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
                window.location.href = "{{ route('hki.user.index') }}";
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
