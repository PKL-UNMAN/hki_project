@extends('layouts.templateBaru',['title'=>'PO Supplier'])
@section('content')
<div class="container">
	<h3>Purchase Order Supplier</h3>
	@if (session()->has('success'))
    <script>
        window.onload = function () {
                swal.fire("Berhasil");
            };
    </script>
    @endif
	
    <div style="text-align: left">
        <a href="{{route('hki.po.supplier.create')}}" class="btn btn-primary">Tambah PO</a>
        <a href="#" class="btn btn-info" style="color: white">Upload PO</a>
    </div>

    <div class="row">
        <div class="col col-md-12 col-12 mt-2">
            <div class="ss" data-aos="fade-up">
                <table id="hki-po-supplier" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PO No</th>
                            <th>Part No</th>
                            <th>Part Name</th>
                            <th>Class</th>
                            <th>Composition</th>
                            <th>Unit</th>
                            <th style="text-align: center">ID<br>(Default Supplier)</th>
                            <th>Nama Perusahaan</th>
                            <th>Unit Price</th>
                            <th>Ammount</th>
                            <th>Currency</th>
                            <th>QTY</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       {{-- @foreach($PO as $data)
                        <tr>
                            <td>{{$data->no}}</td>
                            <td>{{$data->no}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->issue_date}}</td>
                            <td>{{$data->part_no}}</td>
                            <td>{{$data->order_qty}}</td>
                            <td>{{$data->weight}}</td>
                            <td>{{$data->order_no}}</td>
                            <td>{{$data->po_number}}</td>
                            <td>{{$data->delivery_time}}</td>
                            <td>{{$data->po_number}}</td>
                            <td>{{$data->po_number}}</td>
                            <td>{{$data->po_number}}</td>
                            <td>{{$data->po_number}}</td>

                            <td style="width:40%">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="status" class="form-select" id="status{{$data->no}}" onchange="ubahStatus({{$data->no}})" >
                                            <option value="" @if($data->status == "") selected @endif>--Status --</option>
                                            <option value="On Progress" @if($data->status == "On Progress") selected @endif>On Progress</option>
                                            <option value="Finish"  @if($data->status == "Finish") selected @endif>Finish</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('hki.po.supplier.edit', $data->no)}}" class="btn btn-warning">Edit</a>
                                        <a id="hapus" onclick="modalHapus({{$data->no}})" href="#" class="btn btn-danger">Delete</a>
                                        <a href="#" onclick="modalRead({{$data->no}})" class="btn btn-info">Read</a>
                                        <a href="{{route('supplier.po.download', $data->no)}}" class="btn btn-primary">Download</a>
                                    </div>
                                </div>  
                            </td>
                        </tr>
                      @endforeach --}}
                    </tbody>
                </table>
              </div>
        </div>
    </div>
	
  
</div>
{{--modal--}}
<div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
     var t = $('#hki-po-supplier').DataTable({
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
    // function memanggil modal hapus
    function modalHapus(no){
        Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Untuk menghapus PO?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url: "{{ url('hki/po/supplier/destroy') }}/" + no,
                success: function(data) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success',
                    '3000'
                    )
                    location.reload(true);
                }
            });
            
        }
    })
        }


        // Function ubah status PO
        function ubahStatus(no){
        var status = $("#status"+no).val();
      $.ajax({
              type: "get",
              url: "{{ url('ubahstatus') }}",
              data: {
              "no": no,
              "status": status,
              },
              success: function(data, status) {
                console.log(data)
                Swal.fire(
                    {
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Status Berhasil Diubah!'
                        }
                    )
              }
             
          });
     }
     function modalRead(no) {
        $.get("{{ url('hki/supplier/po/detailpo') }}/" + no, {}, function(data, status) {
            $("#exampleModalCenterTitle").html(`Detail Purchase Order`)
            $("#page").html(data);
            $("#exampleModalCenter").modal('show');
           })  
    }

 </script>


 @endsection