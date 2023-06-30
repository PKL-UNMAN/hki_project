@extends('layouts.templateBaru',['title'=>'PO Subcon'])
@section('content')
<div class="container">
	<h3>Purchase Order Subcon</h3>
	@if ($message = session('success'))
    <script>
        window.onload = function () {
                swal.fire("{{$message}}");
            };
    </script>
        @elseif($message =session('fail'))
        <script>
            window.onload = function () {
                    swal.fire("{{$message}}");
                };
        </script>
        @endif
	
    <div style="text-align: left">
        <a href="{{route('hki.po.subcon.create')}}" class="btn btn-primary">Tambah PO</a>
        <a href="#" class="btn btn-info" style="color: white">Upload PO</a>
    </div>

    <div class="row">
        <div class="col col-md-12 col-12 mt-2">
            <div class="ss" data-aos="fade-up">
                <table id="myTable2" class="display nowrap" style="width:100%">
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
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>QTY</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;    
                        @endphp
                       @foreach($PO as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->po_number}}</td>
                            <td>{{$data->part_no}}</td>
                            <td>{{$data->part_name}}</td>
                            <td>{{$data->class}}</td>
                            <td>{{$data->composition}}</td>
                            <td>{{$data->unit}}</td>
                            <td>{{$data->default_supplier_id}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->unit_price}}</td>
                            <td>{{$data->amount}}</td>
                            <td>{{$data->currency_code}}</td>
                            <td>{{$data->order_qty}}</td>
                            <td>
                                <select name="status" class="form-select" id="status{{$data->id_po}}" onchange="ubahStatus({{$data->id}})" >
                                    <option value="" @if($data->status == "") selected @endif>--Status --</option>
                                    <option value="On Progress" @if($data->status == "On Progress") selected @endif>On Progress</option>
                                    <option value="Finish"  @if($data->status == "Finish") selected @endif>Finish</option>
                                </select>
                            </td>
                            <td style="width:40%">
                                        <a href="{{url('hki/po/subcon/edit/'.$data->id_po.'/'.$data->default_supplier_id)}}" class="btn btn-warning">Edit</a>
                                        <a id="hapus" onclick="modalHapus({{$data->id_po}})" href="#" class="btn btn-danger">Delete</a>
                                        <a href="#" onclick="modalRead({{$data->id_po}})" class="btn btn-info">Read</a>
                                        <a href="{{route('supplier.po.download', $data->id_po)}}" class="btn btn-primary">Download</a>
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
    $(document).ready(function () {
     var t = $('#myTable2').DataTable({
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
        confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url: "{{ url('hki/po/subcon/destroy') }}/" + no,
                success: function(data) {
                    Swal.fire(
                    'Berhasil!',
                    'PO Subcon Berhasil Dihapus.',
                    'success',
                    '5000'
                    )
                    // location.reload(true);
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

 </script>


 @endsection