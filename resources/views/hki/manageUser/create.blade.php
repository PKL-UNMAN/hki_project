@extends('layouts.templateBaru', ['title' => 'Tambah User'])
@section('content')
    <div class="container">
        <h1 class="left-align" style="text-align: left;">Tambah User</h1>
        <p class="left-align" style="text-align: left;">Dashboard>Data Master>Tambah User</p>
        <div class="card">
            <div class="xformdm">
                <div class="form mt-4">
                    <form enctype="multipart/form-data" action="{{ route('hki.user.store') }}" method="POST">
                        @csrf
                        <div style="text-align: left" class="row">
                            <div class="col col-md-6 mt-6">
                                <div class="col col-md-12 col-12 mt-2">
                                    <div class="form-group">
                                        <label for="nama_barang" style="margin-bottom: 10px;">Username</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="username" placeholder="Masukkan Username"
                                            value="{{ old('username') }}">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                </div>
                                <div class="col col-md-12 col-12 mt-4">
                                    <div class="form-group">
                                        <label for="password" style="margin-bottom: 10px;">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Masukkan email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                </div>
                                <div class="col col-md-12 col-12 mt-4">
                                    <div class="form-group">
                                        <label for="password" style="margin-bottom: 10px;">Password</label>
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

                                <div class="col col-md-12 col-12 mt-4">
                                    <div class="form-group">
                                        <label for="#" style="margin-bottom: 10px;">Id Perusahaan</label>
                                        <input type="number" class="form-control @error('#') is-invalid @enderror"
                                            id="#" name="id_perusahaan" placeholder="Masukkan ID Perusahaan"
                                            value="{{ old('id_perusahaan') }}">
                                        @error('id_perusahaan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                </div>


                                <div class="col col-md-12 col-12 mt-4">
                                    <div class="form-group">
                                        <label for="#" style="margin-bottom: 10px;">Nama Perusahaan</label>
                                        <input type="#" class="form-control @error('#') is-invalid @enderror"
                                            id="#" name="company" placeholder="Masukkan Nama Perusahaan"
                                            value="{{ old('company') }}">
                                        @error('company')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                </div>

                                <div class="col col-md-12 col-12 mt-4">
                                    <div class="form-group">
                                        <label for="level" style="margin-bottom: 10px;">Role Name</label>
                                        <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                            <option value="" selected disabled>-- Pilih Level Akun --</option>
                                            @foreach ($role as $data)
                                                <option value="{{ $data->role_id }}">{{ $data->role_name }}</option>
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
                                        <label for="level" style="margin-bottom: 10px;">Class</label>
                                        <select name="class" class="form-control @error('class') is-invalid @enderror">
                                            <option value="" selected disabled>-- Pilih Class --</option>
                                            <option>HKI</option>
                                            <option>SUBCON</option>
                                            <option>SUPPLIER</option>
                                        </select>
                                        @error('class')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col col-md-6 mt-6">
                                <div class="col col-md-12 col-12 mt-2">
                                    <div class="form-group">
                                        <label for="nama_barang" style="margin-bottom: 10px;">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" name="alamat" placeholder="Masukkan Alamat"
                                            value="{{ old('alamat') }}">
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                </div>
                                <div class="col col-md-12 col-12 mt-4">
                                    <div class="form-group">
                                        <label for="nama_barang" style="margin-bottom: 10px;">Telepon</label>
                                        <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                            id="telepon" name="telepon" placeholder="Masukkan telepon"
                                            value="{{ old('telepon') }}">
                                        @error('telepon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                </div>
                                <div class="col col-md-12 col-12 mt-4">
                                    <div class="form-group">
                                        <label for="nama_barang" style="margin-bottom: 10px;">Fax</label>
                                        <input type="text" class="form-control @error('fax') is-invalid @enderror"
                                            id="fax" name="fax" placeholder="Masukkan fax"
                                            value="{{ old('fax') }}">
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
                            <button type="submit" class="btn btn-primary">Tambah User</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
