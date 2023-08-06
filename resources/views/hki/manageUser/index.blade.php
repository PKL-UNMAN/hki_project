@extends('layouts.templateBaru', ['title' => 'Manage User'])
@section('content')
    <div class="container">
        <h1 class="left-align" style="text-align: left;">Data Master</h1>
        <p class="left-align" style="text-align: left;">Dashboard>Data Master>User</p>
        <div class="d-flex justify-content-end">
            <a href="{{ route('hki.user.create') }}" class="btn btn-primary" style="width:300px">Tambah User</a>
        </div>
        @if ($message = session('success'))
            <script>
                window.onload = function() {
                    swal.fire("{{$message}}");
                };
            </script>
        @endif  

        <div class="row">
            <div class="col-12 mt-2">
                <div class="ss" data-aos="fade-up">
                    <table id="myTable2" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Perusahaan</th>
                                <th>Name Perusahaan</th>
                                <th>Role</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody>
                            @php
                                $no = 1
                            @endphp
                            @foreach ($user as $data)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$data->id_perusahaan}}</td>
                                    <td>{{$data->nama}}</td>
                                    <td>{{$data->id.' - '.$data->role_name}}</td>
                                    <td>{{$data->class}}</td>
                                    <td>
                                        @if ($data->role_id == '1')
                                            <a href="{{ route('hki.user.edit', $data->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                        @else
                                            <a href="{{ route('hki.user.edit', $data->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <a id="hapus" href="#" onclick="modalHapus({{ $data->id }})"
                                                class="btn btn-danger btn-sm">Hapus</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </div>


    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var t = $('#myTable2').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                stateSave: true,
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }, ],
                order: [
                    [1, 'asc']
                ],

            });

            t.on('order.dt search.dt', function() {
                let i = 1;

                t.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();
        });
    </script>

    <script>
        function modalHapus(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Untuk menghapus user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('hki/user/destroy') }}/" + id,
                        success: function(data) {
                            location.reload(true);
                            Swal.fire(
                                'Berhasil!',
                                'User berhasil dihapus',
                                'success',
                                '10000'
                            )
                        }
                    });

                }
            })
        }
    </script>
@endsection
