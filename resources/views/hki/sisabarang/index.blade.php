@extends('layouts.templateBaru', ['title' => 'Sisa Barang'])
@section('content')
    <div class="container">
        <h1 class="left-align" style="text-align: left;">Sisa Barang</h1>
        <p class="left-align" style="text-align: left;">Dashboard>Riwayat Sisa Barang</p>
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
                                <th>Nama Perusahaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                        @foreach ($groupSubcon as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->pengirim}}</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->po_number}}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    @foreach ($groupSubcon as $item)
    <!-- Modal -->
    <div class="modal fade" id="exampleModal{{$item->po_number}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Sisa Barang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
  <div class="xformdm">
      <div style="text-align: left" class="row">
                          <div class="col col-md-12 col-12 mt-2">
                              <div class="form-group">
                                  <label for="password">PO Number</label>
                                  <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number" name="po_number" value="{{$item->po_number}}" readonly>
                                  @error('po_number')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                              </div>
                          </div>
  
                          <table class="table mt-3">
                              <tr>
                                  <th>No. Surat</th>
                                  <th>Order Number</th>
                                  <th>Part Name</th>
                                  <th>Tanggal Pengiriman</th>
                                  <th>Sisa</th>
                              </tr>
                              @foreach ($sisa as $item1)
                              <tr>
                                  <td>{{$item1->no_surat}}</td>
                                  <td>{{$item1->order_number}}</td>
                                  <td>{{$item1->part_name}}</td>
                                  <td>{{$item1->tanggal}}</td>
                                  <td>{{$item1->sisa}}</td>
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
