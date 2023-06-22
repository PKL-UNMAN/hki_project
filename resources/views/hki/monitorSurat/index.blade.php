@extends('layouts.templateBaru',['title'=>'Surat Jalan'])
@section('content')
<div class="container">
	<h3>Monitor Surat</h3>
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
    <a>Dashboard>Monitor Surat</a>
    <br>
    <br>
    <div class="row">
        <div class="col col-md-12 col-12 mt-2">
            <div class="ss" data-aos="fade-up">
                <table id="surat_hki" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align: center">No</th>
                            <th style="text-align: center">ID <br>(default supplier)</th>
                            <th style="text-align: center">Nama Perusahaan<br>(supllier name)</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($surat as $data)
                        <tr>
                            <td></td>
                            <td>{{$data->part_name}}</td>
                            <td>{{$data->part_no}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->order_no}}</td>
                            <td>{{$data->delivery_time}}</td>
                            <td>{{$data->order_no}}</td>
                            <td>{{$data->order_no}}</td>
                            <td>{{$data->order_no}}</td>
                            <td>{{$data->order_no}}</td>

                            <td>
                                @if($data->status == "On Progress")
                                <span class="badge" style="background-color: orangered">On Progress</span>
                                @elseif($data->status == "Finish")
                                <span class="badge" style="background-color: rgb(0, 193, 55)">Accepted</span>
                                @endif
                            </td>
                            <td>
                                @if($data->status == "On Progress")
                                <a href="#" class="btn btn-success" onclick="modalACC({{$data->no_surat}})">ACC</a>
                                @endif
                                <a href="#" class="btn btn-warning" onclick="modalREAD({{$data->no_surat}})">READ</a>
                                <a href="{{route('subcon.surat.download', $data->no_surat)}}" class="btn btn-primary">Download</a>
                            </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
              </div>
        </div>
    </div>
	
  
</div>

{{-- Modal --}}
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    $(document).ready(function () {
     var t = $('#surat_hki').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        stateSave: true,
        columnDefs: [
             {
                 searchable: false,
                 orderable: false,
                 targets: 0,
             },
         ],
         order: [[1, 'asc']],

    });

    t.on('order.dt search.dt', function () {
         let i = 1;
  
         t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
             this.data(i++);
         });
     }).draw();
 });
 </script>

<script>
    function modalACC(no_surat){
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
        $.get("{{ url('hki/surat/read') }}/"+no_surat, {}, function(data, status) {
            $("#exampleModalCenterTitle").html(`Detail Surat`)
            $("#page").html(data);
            $("#exampleModalCenter").modal('show');
           })  
    }

 </script>




 @endsection