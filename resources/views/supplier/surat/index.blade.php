@extends('layouts.templateBaru', ['title' => 'Surat Jalan'])
@section('content')
    <div class="container">
        <h3>Surat Jalan HKI {{ Auth::user()->name }}</h3>
        @if (session()->has('success'))
            <script>
                window.onload = function() {
                    swal.fire("Berhasil");
                };
            </script>
        @endif

        @if (session()->has('error'))
            <script>
                window.onload = function() {
                    swal.fire("Gagal, Pastikan Semua Data Sudah Terisi Semua");
                };
            </script>
        @endif
        <div class="row">
            <div class="col-2  mt-2 mb-4">
                <a href="#" onclick="tambahSurat()" class="btn btn-primary" style="width:150px">Tambah Surat</a>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-12 col-12 mt-2">
                <div class="ss" data-aos="fade-up">
                    <table id="suratsupp" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>PO Number</th>
                                <th>Pengirim</th>
                                <th>Tujuan Pengiriman</th>
                                <th>Tanggal Pengiriman</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surat as $data)
                                <tr>
                                    <td></td>
                                    <td>{{ $data->po_number }}</td>
                                    <td>{{ $data->pengirim }}</td>
                                    <td>{{ $data->penerima }}</td>
                                    <td> {{$data->tanggal}} </td>
                                    <td>
                                        @if ($data->status == 'On Progress')
                                        <span class="badge" style="background-color: orangered">On Progress</span>
                                        @elseif($data->status == 'Finish')
                                        <span class="badge" style="background-color: rgb(0, 193, 55)">Accepted</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('subcon.surat.edit', $data->no_surat) }}"
                                            class="btn btn-warning">Edit</a>
                                        <a id="hapus" onclick="modalHapus({{ $data->no_surat }})" href="#"
                                            class="btn btn-danger">Delete</a>
                                        <a href="#" onclick="modalREAD({{ $data->no_surat }})"
                                            class="btn btn-warning">READ</a>
                                        <a href="{{ route('subcon.surat.download', $data->no_surat) }}"
                                            class="btn btn-primary">Download</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                </table>
                </div>
            </div>

        </div>


    </div>

    {{-- Modal --}}
    <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Buat Surat Jalan</h5>
                </div>
                <div class="modal-body">
                    <p class="mb-0" id="page"></p>
                </div>
                <div id="modalFooter" class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    {{-- endModal --}}
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var t = $('#suratsupp').DataTable({
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
        function tambahSurat() {
            $.get("{{ url('supplier/surat/create') }}", {}, function(data, status) {
                var part_name = $(this).data('part_name');
                $("#part_name").val(part_name);
                $("#exampleModalCenterTitle").html(`Buat Surat`)
                $("#page").html(data);
                $("#exampleModalCenter").modal('show');
            })
        }

        function modalREAD(no_surat) {
            $.get("{{ url('subcon/surat/read') }}/" + no_surat, {}, function(data, status) {
                $("#exampleModalCenterTitle").html(`Detail Surat`)
                $("#page").html(data);
                $("#exampleModalCenter").modal('show');
            })
        }

        // function memanggil modal hapus
        function modalHapus(no) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Untuk menghapus Surat Jalan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('subcon/surat/delete') }}/" + no,
                        success: function(data) {
                            console.log(data)
                            Swal.fire(
                                'Success!',
                                'Berhasil hapus Surat Jalan.',
                                'success',
                                '3000'
                            )
                            location.reload(true);
                        }
                    });

                }
            })
        }
    </script>


    @if (session()->has('error'))
        <script>
            $(function() {
                var part_name = $("#part_name").val();
                tambahSurat()
                document.getElementById('alert').style.display = "block";
            });
        </script>
    @endif
@endsection
