@extends('layouts.templateBaru',['title'=>'PO Subcon'])
@section('content')
<div class="container">
    <div class="header bg-primary text-light pb-3 pt-4 mb-3 rounded shadow">
        <h3><i class="fa-solid fa-cart-shopping fa-lg"></i> Purchase Order Subcon</h3>
    </div>
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
	
    <div class="mb-2" style="text-align: left">
        <a href="{{route('hki.po.subcon.create')}}" class="btn btn-primary shadow"><i class="fa-solid fa-square-plus"></i> Tambah PO</a>
        <a href="#" class="btn btn-info shadow" style="color: white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-sharp fa-solid fa-cloud-arrow-up"></i> Upload PO</a>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('hki/import/po/subcon') }}"
                method="POST"
                enctype="multipart/form-data">
              @csrf
              <input type="file" name="file" class="form-control">
              <input type="hidden" name="class" value="SUBCON">
              <input type="hidden" name="role_id" value="2">
              <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </form>
          </div>
        </div>
      </div>

    <div class="row">
        <div class="col col-md-12 col-12 mt-2">
            <div class="ss" data-aos="fade-up">
                <table id="myTable2" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PO No</th>
                            <th>Issue Date</th>
                            <th>Class</th>
                            <th style="text-align: center">ID<br>(Default Supplier)</th>
                            <th>Currency</th>
                            <th>Nama Perusahaan</th>
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
                            <td>{{$data->issue_date}}</td>
                            <td>{{$data->class}}</td>
                            <td>{{$data->default_supplier_id}}</td>
                            <td>{{$data->currency_code}}</td>
                            <td>{{$data->nama}}</td>
                            <td>
                                <select name="status" class="form-select" id="status{{$data->id_po}}" onchange="ubahStatus({{$data->id}})" >
                                    <option value="" @if($data->status == "") selected @endif>--Status --</option>
                                    <option value="Unsend" @if($data->status == "Unsend") selected @endif>Unsend</option>
                                    <option value="On Progress" @if($data->status == "On Progress") selected @endif>On Progress</option>
                                    <option value="Finish"  @if($data->status == "Finish") selected @endif>Finish</option>
                                </select>
                            </td>
                            <td style="width:40%">
                                        <a href="{{url('hki/po/subcon/edit/'.$data->id_po)}}" class="btn btn-warning">Edit</a>
                                        <a id="hapus" onclick="modalHapus({{$data->id_po}})" href="#" class="btn btn-danger">Delete</a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id_po}}" class="btn btn-info">Read</a>
                                        <a href="{{url('subcon/po/download/'.$data->id_po)}}" class="btn btn-primary">Download</a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
        </div>
    </div>
  @foreach ($detail_PO as $item)
  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{$item->id_po}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Purchase Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
<div class="xformdm">
    <div style="text-align: left" class="row">
                        <div class="col col-md-12 col-12 mt-2">
                            <div class="form-group">
                                <label for="password">PO Number</label>
                                <input type="number" class="form-control @error('po_number') is-invalid @enderror" id="po_number" name="po_number" placeholder="Masukkan po_number" value="{{$item->po_number}}" readonly>
                                @error('po_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                        </div>

                        <div class="col col-md-12 col-12 mt-2">
                            <div class="form-group">
                                <label for="password">Delivery Time</label>
                                <input type="text" class="form-control @error('delivery_time') is-invalid @enderror" id="delivery_time" name="delivery_time" placeholder="Masukkan delivery_time" value="{{$item->delivery_time}}" readonly>
                                @error('delivery_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <table class="table mt-3">
                            <tr>
                                <th>No. Part</th>
                                <th>Part Name</th>
                                <th>QTY</th>
                                <th>Unit</th>
                                <th>Tanggal Pengiriman</th>
                            </tr>
                            @foreach ($detail_PO as $item1)
                            <tr>
                                <td>{{$item1->part_no}}</td>
                                <td>{{$item1->part_name}}</td>
                                <td>{{$item1->order_qty}}</td>
                                <td>{{$item1->unit}}</td>
                                <td>{{$item1->delivery_time}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
              
                </div>
            </div>
                
        </div>
      </div>
    </div>
  </div>
  
</div>      
  @endforeach

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
                    '10000'
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

    //  function modalRead(no) {
    //     $.get("{{ url('hki/subcon/po/detailpo') }}/" + no, {}, function(data, status) {
    //         $("#exampleModalCenterTitle").html(`Detail Purchase Order`)
    //         $("#page").html(data);
    //         $("#exampleModalCenter").modal('show');
    //        })  
    // }

 </script>


 @endsection