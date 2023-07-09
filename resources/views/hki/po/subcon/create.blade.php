@extends('layouts.templateBaru',['title'=>'Add PO Subcon'])
@section('content')

<div class="container">
    <div class="card shadow-sm">
        <div class="xformdm ">
            <div class="card-header bg-primary text-light pt-3 rounded">
                <center>
                    <h3>Tambah PO Subcon</h3>
                </center>
            </div>
      
            <div class="form mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group text-start">
                                <label for="" class=" fw-bold "><i class="fa-solid fa-location-dot"></i> Tujuan Subcon (Nama Perusahaan)</label>
                                <select name="id_tujuan" id="id_tujuan" class="form-control @error('id_tujuan') is-invalid @enderror">
                                <option value="1" selected disabled>-- Pilih Subcon --</option>
                                    @foreach($subcon as $data)
                                    <option data-id="{{$data->id}}" data-class="SUBCON" value="{{$data->id}}">{{$data->id}} - {{$data->nama}}</option>
                                    @endforeach
                                </select>
                                @error('id_tujuan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3 text-start">
                                <label for="po number" class=" fw-bold" ><i class="fa-solid fa-envelope"></i> PO Number</label>
                                <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number" placeholder="Masukkan po_number" value="{{old('po_number')}}">
                                @error('po_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3 text-start">
                                <label for="" class="fw-bold"><i class="fa-solid fa-truck"></i> Tujuan Pengiriman (Delivery Destination)</label>
                                <input type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" placeholder="Masukkan destination" value="{{session('id_user')}}">
                                @error('destination')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">    
                            <div class="form-group text-start">
                                <label for="default_id" class="fw-bold"><i class="fa-solid fa-address-card "></i> ID HKI</label>
                                <input type="text" class="form-control @error('default_id') is-invalid @enderror" id="default_id" placeholder="Masukkan default_id" value="{{session('id_user')}}">
                                @error('default_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3 text-start">
                                <label for="issue_date" class="fw-bold"><i class="fa-solid fa-calendar-days"></i> Issue Date</label>
                                <input type="text" class="form-control @error('issue_date') is-invalid @enderror" id="issue_date" placeholder="Masukkan issue_date">
                                @error('issue_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3 text-start">
                                <label for="delivery_date" class="fw-bold"><i class="fa-solid fa-calendar-days"></i> Delivery Date</label>
                                <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" id="delivery_date">
                                @error('delivery_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-start">
                                <label for="classname" class="fw-bold"><i class="fa-solid fa-people-group"></i> Class</label>
                                <input type="text" class="form-control @error('class') is-invalid @enderror" id="classname" placeholder="Masukkan class">
                                @error('classname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3 text-start">
                                <label for="currency" class="fw-bold"><i class="fa-solid fa-coins"></i> Currency</label>
                                <select id="currency" class="form-control @error('currency') is-invalid @enderror">
                                    <option value="1" selected disabled>-- Pilih Currency --</option>
                                    <option>IDR</option>
                                </select>
                                @error('currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>
          
        </div>

    </div>

    <div class="card shadow-sm mt-3">
        <div class="container">
            <form class="temp">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group text-start">
                        <label for="part_no" class="fw-bold"><i class="fa-solid fa-tag"></i> Part No.</label>
                        <input type="text" class="form-control @error('part_no') is-invalid @enderror" id="part_no" placeholder="Masukkan part_no">
                        @error('part_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 text-start">
                        <label for="qty" class="fw-bold"><i class="fa-solid fa-list-ol"></i> QTY</label>
                        <input type="text" class="form-control @error('qty') is-invalid @enderror" id="qty" placeholder="Masukkan qty">
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 text-start">
                        <label for="composition" class="fw-bold"><i class="fa-solid fa-calculator"></i> Composition</label>
                        <input type="text" class="form-control @error('composition') is-invalid @enderror" id="composition" placeholder="Masukkan composition">
                        @error('composition')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group text-start">
                        <label for="part_name" class="fw-bold"><i class="fa-solid fa-tag"></i> Part Name</label>
                        <input type="text" class="form-control @error('part_name') is-invalid @enderror" id="part_name" placeholder="Masukkan part_name">
                        @error('part_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 text-start">
                        <label for="unit" class="fw-bold"><i class="fa-solid fa-weight-scale"></i> Unit</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" placeholder="Masukkan unit">
                        @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 text-start">
                        <label for="amount" class="fw-bold"><i class="fa-solid fa-calculator"></i> Amount</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Masukkan amount">
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group text-start">
                        <label for="unit_price" class="fw-bold"><i class="fa-solid fa-money-check-dollar"></i> Unit Price</label>
                        <input type="text" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" placeholder="Masukkan unit_price">
                        @error('unit_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3 text-start">
                        <label for="order_number" class="fw-bold"><i class="fa-solid fa-tag"></i> Order Number</label>
                        <input type="text" class="form-control @error('order_number') is-invalid @enderror" id="order_number" placeholder="Masukkan order_number">
                        @error('order_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <a href="javascript:void(0);" id="tambah" style="margin-left: 900px" class="shadow-sm mt-3 btn btn-success disabled"><i class="fa-solid fa-circle-plus"></i> Tambah Item</a>
<form id="formPO" method="POST" action="{{route('hki.po.subcon.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="po">
            <input type="hidden" name="id_tujuan" value="">
            <input type="hidden" name="po_number" value="">
            <input type="hidden" name="destination" value="">
            <input type="hidden" name="default_id" value="">
            <input type="hidden" name="issue_date" value="">
            <input type="hidden" name="delivery_date" value="">
            <input type="hidden" name="classname" value="">
            <input type="hidden" name="currency" value="">
        </div>
    <table id="myTable" class="table" style="margin-top: 40px">
        <tbody>
            <tr>
                <th>No</th>
                <th>Part No</th>
                <th>Part Name</th>
                <th>Unit Price</th>
                <th>Composition</th>
                <th>QTY</th>
                <th>Unit</th>
                <th>Amount</th>
                <th>Order Number</th>
                <th>Action</th>
            </tr>
        <tr>
            </tr>
        </tbody>
    </table>
        <button style="margin-left: 900px" type="submit" id="simpan" class="btn btn-primary shadow-sm fw-bold"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
</form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#id_tujuan').on('change', function(){
            // const default_id = $('#id_tujuan option:selected').data('id');
            // $('#default_id').val(default_id);
            const class_name = $('#id_tujuan option:selected').data('class');
            $('#classname').val(class_name);
        });
        $('#po_number').keyup(function(){
            date = new Date();
            const issue_date = $('#issue_date').val(date.toLocaleDateString('id-ID')+' - '+date.toLocaleTimeString('id-ID'))
        });
        //Ketika tambah item saja!!!!
        $('#part_no').keyup(function(){
            let id_tujuan = $('#id_tujuan').val()
            let po_num = $('#po_number').val()
            let destination = $('#destination').val()
            let default_id = $('#default_id').val()
            let issue_date = $('#issue_date').val()
            let delivery_date = $('#delivery_date').val()
            let classname = $('#classname').val()
            let currency = $('#currency').val()
            $('[name="id_tujuan"]').val(id_tujuan)
            $('[name="po_number"]').val(po_num)
            $('[name="destination"]').val(destination)
            $('[name="default_id"]').val(default_id)
            $('[name="issue_date"]').val(issue_date)
            $('[name="delivery_date"]').val(delivery_date)
            $('[name="classname"]').val(classname)
            $('[name="currency"]').val(currency)
        });
        $('#composition').keyup(function(){
            let amount = ($('#unit_price').val()*$('#composition').val())*$('#qty').val()
            $('#amount').val(amount)
        })

        $('form.temp .form-group input').keyup(function(){
            $(this).each(function() {
                let val =$(this).val().length
                if (val == 0) {
                    $('.btn-success').addClass('disabled')
                }else{
                    $('.btn-success').removeClass('disabled')
                }
            })
        });

    })

    let no = 0
    $('#tambah').click(function() {

        no++
       $('#myTable tbody').append('<tr id=row'+no+' class="child">'+
        '<td>'+no+'</td>'+
        '<td><input class="form-control" name="part_no[]" value='+$('#part_no').val()+'></td>'+
        '<td><input class="form-control" name="part_name[]" value='+$('#part_name').val()+'></td>'+
        '<td><input class="form-control" name="unit_price[]" value='+$('#unit_price').val()+'></td>'+
        '<td><input class="form-control" name="composition[]" value='+$('#composition').val()+'></td>'+
        '<td><input class="form-control" name="qty[]" value='+$('#qty').val()+'></td>'+
        '<td><input class="form-control" name="unit[]" value='+$('#unit').val()+'></td>'+
        '<td><input class="form-control" name="amount[]" value='+$('#amount').val()+'></td>'+
        '<td><input class="form-control" name="order_number[]" value='+$('#order_number').val()+'></td>'+
        '<td><a href="javascript:void(0)" id=delete'+no+' class="btn btn-danger">Hapus</a></td>'+
        '</tr>');
        $('#part_no').val('')
        $('#part_name').val('')
        $('#unit_price').val('')
        $('#composition').val('')
        $('#qty').val('')
        $('#unit').val('')
        $('#amount').val('')
        $('#order_number').val('')
        $('#delete'+no).click(function() {
            $('#row'+no).remove()
            no--
        })
    });
</script>

@endsection