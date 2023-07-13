@extends('layouts.templateBaru', ['title' => 'Sisa Barang'])
@section('content')
    <div class="container">
        <h1 class="left-align" style="text-align: left;">Sisa Barang</h1>
        <p class="left-align" style="text-align: left;">Dashboard>Sisa Barang</p>
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
            <div class="col col-md-12 col-12 mt-2">
                <div class="ss" data-aos="fade-up">
                    <table id="surat_hki" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID <br>(default supplier)</th>
                                <th>Nama Perusahaan<br>(supllier name)</th>
                                <th>Part No</th>
                                <th>Part Name</th>
                                <th>Sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                        @foreach ($sisa as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->default_supplier_id}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->part_name}}</td>
                            <td>{{$data->part_no}}</td>
                            @foreach ($count as $item)
                                @if ($data->po_number === $item->po_number)
                                    <td></td>
                                @else
                                    <td>Sisa tidak diketahui</td>
                                @endif
                            @endforeach
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
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
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
            var t = $('#surat_hki').DataTable({
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
        function modalACC(no_surat) {
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
                        url: "{{ url('hki/surat/status') }}/" + no_surat,
                        success: function(data) {
                            Swal.fire(
                                'Surat Disetujui!',
                                'Status diubah menjadi Finish.',
                                'success',
                                '3000'
                            )
                            location.reload(true);
                        }
                    });

                }
            })
        }

        function modalREAD(no_surat) {
            $.get("{{ url('hki/surat/read') }}/" + no_surat, {}, function(data, status) {
                $("#exampleModalCenterTitle").html(`Detail Surat`)
                $("#page").html(data);
                $("#exampleModalCenter").modal('show');
            })
        }
    </script>
@endsection
