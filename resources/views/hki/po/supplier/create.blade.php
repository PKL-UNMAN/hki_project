@extends('layouts.templateBaru',['title'=>'Add PO Supplier'])
@section('content')

<div class="container">
    <div class="card">
        <div class="xformdm">
            <center>
                <h3>Tambah PO Supplier</h3>
            </center>
            <div class="text-center mt-4" style="margin-left: 800px">
                <a href="javascript:void(0);" id="tambah">Tambah Item</a>
              </div>
<form id="formPO" method="POST" action="{{route('hki.po.supplier.store')}}" enctype="multipart/form-data">
    @csrf
            <div class="form mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="text-left">Tujuan Supplier (Nama Perusahaan)</label>
                                <select name="id_tujuan" id="id_tujuan" class="form-control @error('id_tujuan') is-invalid @enderror">
                                    <option value="1" selected disabled>-- Pilih Supplier --</option>
                                    @foreach($supplier as $data)
                                    <option data-id="{{$data->id}}" data-class="SUPPLIER" value="{{$data->id}}">{{$data->nama}}</option>
                                    @endforeach
                                </select>
                                @error('id_tujuan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">PO Number</label>
                                <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number" placeholder="Masukkan po_number" value="{{old('po_number')}}">
                                @error('po_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="" class="text-left">Tujuan Pengiriman (Delivery Destination)</label>
                                <select id="destination" class="form-control @error('destination') is-invalid @enderror">
                                    <option value="1" selected disabled>-- Pilih Subcon --</option>
                                    @foreach($subcon as $data)
                                        <option value="{{$data->id}}">{{$data->nama}}</option>
                                    @endforeach
                                </select>
                                @error('destination')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="default_id">ID Default Supplier</label>
                                <input type="text" class="form-control @error('default_id') is-invalid @enderror" id="default_id" placeholder="Masukkan default_id">
                                @error('po_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="issue_date">Issue Date</label>
                                <input type="text" class="form-control @error('issue_date') is-invalid @enderror" id="issue_date" placeholder="Masukkan issue_date">
                                @error('issue_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="class">Class</label>
                                <input type="text" class="form-control @error('class') is-invalid @enderror" id="classname" placeholder="Masukkan class">
                                @error('class')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="" class="text-left">Currency</label>
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

    <div class="card mt-3">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Part No.</label>
                        <input type="text" class="form-control @error('part_no') is-invalid @enderror" id="part_no" placeholder="Masukkan part_no">
                        @error('part_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">QTY</label>
                        <input type="text" class="form-control @error('qty') is-invalid @enderror" id="qty" placeholder="Masukkan qty">
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Composition</label>
                        <input type="text" class="form-control @error('composition') is-invalid @enderror" id="composition" placeholder="Masukkan composition">
                        @error('composition')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Part Name</label>
                        <input type="text" class="form-control @error('part_name') is-invalid @enderror" id="part_name" placeholder="Masukkan part_name">
                        @error('part_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Unit</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" placeholder="Masukkan unit">
                        @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Amount</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Masukkan amount">
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Unit Price</label>
                        <input type="text" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" placeholder="Masukkan unit_price">
                        @error('unit_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Delivery Date</label>
                        <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" id="delivery_date" placeholder="Masukkan delivery date">
                        @error('delivery_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Order Number</label>
                        <input type="text" class="form-control @error('order_number') is-invalid @enderror" id="order_number" placeholder="Masukkan order_number">
                        @error('order_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="po">
        <input type="text" name="id_tujuan" value="">
        <input type="text" name="po_number" value="">
        <input type="text" name="destination" value="">
        <input type="text" name="default_id" value="">
        <input type="text" name="issue_date" value="">
        <input type="text" name="classname" value="">
        <input type="text" name="currency" value="">
        
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
            <th>Delivery Date</th>
            <th>Order Number</th>
            <th>Action</th>
        </tr>
        <tr>
            </tr>
        </tbody>
    </table>
        <button style="margin-left: 600px" type="submit" id="simpan" class="btn btn-success">Simpan</button>
</form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#id_tujuan').on('change', function(){
            const default_id = $('#id_tujuan option:selected').data('id');
            $('#default_id').val(default_id);
            const class_name = $('#id_tujuan option:selected').data('class');
            $('#classname').val(class_name);
        });
        $('#po_number').keyup(function(){
            date = new Date();
            const issue_date = $('#issue_date').val(date.toLocaleDateString('id-ID'))
        });
        //Ketika tambah item saja!!!!
        $('#part_no').keyup(function(){
            let id_tujuan = $('#id_tujuan').val()
            let po_num = $('#po_number').val()
            let destination = $('#destination').val()
            let default_id = $('#default_id').val()
            let issue_date = $('#issue_date').val()
            let classname = $('#classname').val()
            let currency = $('#currency').val()
            $('[name="id_tujuan"]').val(id_tujuan)
            $('[name="po_number"]').val(po_num)
            $('[name="destination"]').val(destination)
            $('[name="default_id"]').val(default_id)
            $('[name="issue_date"]').val(issue_date)
            $('[name="classname"]').val(classname)
            $('[name="currency"]').val(currency)
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
        '<td><input class="form-control" name="delivery_date[]" value='+$('#delivery_date').val()+'></td>'+
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
        $('#delivery_date').val('')
        $('#order_number').val('')
        $('#delete'+no).click(function() {
            $('#row'+no).remove()
            no--
        })
    });
</script>

@endsection