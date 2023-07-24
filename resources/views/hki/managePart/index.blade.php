@extends('layouts.templateBaru', ['title' => 'Manage User'])
@section('content')
    <div class="container">
        <h1 class="left-align" style="text-align: left;">Data Master</h1>
        <p class="left-align" style="text-align: left;">Dashboard>Data Master>Part</p>
        <div class="d-flex justify-content-end">
            <a href="{{ route('hki.part.create') }}" class="btn btn-primary" style="width:300px">Tambah Part</a>
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
                    <table id="myPart" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produser</th>
                                <th>Id Part</th>
                                <th>Part No</th>
                                <th>Part Name</th>
                                <th>Composition</th>
                                <th>Unit Price</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($part as $data)
                                <tr>
                                    <td></td>
                                    <td>{{$data->nama}}</td>
                                    <td>{{$data->id_part}}</td>
                                    <td>{{$data->part_no}}</td>
                                    <td>{{$data->part_name}}</td>
                                    <td>{{$data->composition}}</td>
                                    <td>{{$data->unit_price}}</td>
                                    <td>
                                        <a href="{{ route('hki.user.edit', $data->id_part) }}"class="btn btn-warning btn-sm">Edit</a>
                                        <a id="hapus" href="#" onclick="modalHapus({{ $data->id_part }})"class="btn btn-danger btn-sm">Hapus</a>
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
            var t = $('#myPart').DataTable({
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
        function modalHapus(id_part) {
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
                        url: "{{ url('hki/part/destroy') }}/" + id_part,
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
