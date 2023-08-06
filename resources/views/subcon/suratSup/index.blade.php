@extends('layouts.templateBaru',['title' => 'Surat Jalan'])
@section('content')
<div class="container">
    <h3>Surat Jalan Supplier {{Auth::user()->name}}</h3>
    <div style="display: flex;justify-content: flex-end;">
        <a href="#" class="btn btn-info" onclick="modalscan()"><i class="bi bi-camera-fill"></i> Scan Barcode</a>
     </div>
    @if (session()->has('success'))
    <script>
        window.onload = function () {
            swal.fire("Berhasil");
        };
    </script>
    @endif

    @if (session()->has('error'))
    <script>
        window.onload = function () {
            swal.fire("Gagal, Pastikan Semua Data Sudah Terisi Semua");
        };
    </script>
    @endif

    <div class="row">
        <div class="col col-md-12 col-12 mt-2">
            <div class="ss" data-aos="fade-up">
                <table id="surat" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <Th>No Surat</Th>
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
                            <td>{{ $data->no_surat }}</td>
                            <td>{{ $data->po_number }}</td>
                            <td>{{ $data->pengirim }}</td>
                            <td>{{ $data->penerima }}</td>
                            <td> {{$data->tanggal}} </td>
                            <td>
                                @if($data->status == "On Progress")
                                <span class="badge" style="background-color: orangered">On Progress</span>
                                @elseif($data->status == "Finish")
                                <span class="badge" style="background-color: rgb(0, 193, 55)">Accepted</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->status == 'On Progress')
                                <a href="#" class="btn btn-success" onclick="modalACC('{{ $data->id }}')">ACC</a>
                                @endif
                                <a href="#" class="btn btn-warning" onclick="modalREAD({{$data->id}})">READ</a>
                                <a href="{{ route('supplier.surat.download', $data->id) }}"
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
<div id="scan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scanTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanTitle">Modal Title</h5>
                </div>
                <div class="modal-body">
                    <p class="mb-0" id="pagescaner"></p>
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
    let html5QrcodeScanner; // Definisikan sebagai variabel global
    $(document).ready(function () {
        var t = $('#surat').DataTable({
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

        t.on('order.dt search.dt', function () {
            let i = 1;

            t.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    });
</script>

<script>
    function modalACC(id) {
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


    function modalREAD(no_surat) {
        $.get("{{ url('subcon/suratSup/read') }}/" + no_surat, {}, function (data, status) {
            $("#exampleModalCenterTitle").html(`Detail Surat`)
            $("#page").html(data);
            $("#exampleModalCenter").modal('show');
        })
    }
    function modalscan( ) {
            $.get("{{ url('subcon/suratSup/scan') }}", {}, function(data, status) {
                $("#scanTitle").html(`Scan Barcode Surat jalan`)
                $("#pagescaner").html(data);
                $("#scan").modal('show');
            })
        }
</script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
@endsection