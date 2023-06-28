@extends('layouts.templateBaru',['title'=>'Edit PO Supplier'])
@section('content')
@section('content')

<div class="container">
    <div class="card">
        <div class="xformdm">
            <center>
                <h3>Edit PO Supplier</h3>
            </center>
            <div class="text-center mt-4" style="margin-left: 800px">
              </div>

            <div class="form mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="text-left">Tujuan Supplier (Nama Perusahaan)</label>
                                <select name="id_tujuan" id="id_tujuan" class="form-control @error('id_tujuan') is-invalid @enderror">
                                <option data-class="SUPPLIER" data-id="{{$supplierBy->id}}" value="{{$PO->id_tujuan}}"> {{$PO->id_tujuan}} - {{$PO->nama}} </option>
                                    @foreach($supplier as $data)
                                    <option data-id="{{$data->id}}" data-class="SUPPLIER" value="{{$data->id}}">{{$data->id}} - {{$data->nama}}</option>
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
                                <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number" placeholder="Masukkan po_number" value="{{$PO->po_number}}">
                                @error('po_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="" class="text-left">Tujuan Pengiriman (Delivery Destination)</label>
                                <select id="destination" class="form-control @error('destination') is-invalid @enderror">
                                    <option value="{{$subconBy->id}}">{{$subconBy->nama}}</option>
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
                                <input type="text" class="form-control @error('default_id') is-invalid @enderror" id="default_id" placeholder="Masukkan default_id" value="{{$PO->default_supplier_id}}">
                                @error('default_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="issue_date">Issue Date</label>
                                <input type="text" class="form-control @error('issue_date') is-invalid @enderror" id="issue_date" placeholder="Masukkan issue_date" value="{{$PO->issue_date}}">
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
                                <input type="text" class="form-control @error('class') is-invalid @enderror" id="classname" placeholder="Masukkan class" value="{{$PO->class}}">
                                @error('classname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="" class="text-left">Currency</label>
                                <select id="currency" class="form-control @error('currency') is-invalid @enderror">
                                    <option value="{{$PO->currency_code}}">-- {{$PO->currency_code}} --</option>
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
        <form id="formPO" method="POST" action="{{url('hki/po/supplier/update/'.$PO->id_po)}}" enctype="multipart/form-data">
            @csrf
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Part No.</label>
                        <input type="text" class="form-control @error('part_no') is-invalid @enderror" name="part_no" placeholder="Masukkan part_no" value="{{$PO->part_no}}">
                        @error('part_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">QTY</label>
                        <input type="text" class="form-control @error('qty') is-invalid @enderror" name="qty" placeholder="Masukkan qty" value="{{$PO->order_qty}}">
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Composition</label>
                        <input type="text" class="form-control @error('composition') is-invalid @enderror" name="composition" placeholder="Masukkan composition" value="{{$PO->composition}}">
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
                        <input type="text" class="form-control @error('part_name') is-invalid @enderror" name="part_name" placeholder="Masukkan part_name" value="{{$PO->part_name}}">
                        @error('part_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Unit</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" placeholder="Masukkan unit" value="{{$PO->unit}}">
                        @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Amount</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="Masukkan amount" value="{{$PO->amount}}">
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
                        <input type="text" class="form-control @error('unit_price') is-invalid @enderror" name="unit_price" placeholder="Masukkan unit_price" value="{{$PO->unit_price}}">
                        @error('unit_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Delivery Date</label>
                        <input type="datetime" class="form-control @error('delivery_date') is-invalid @enderror" name="delivery_date" placeholder="Masukkan delivery date" value="{{$PO->delivery_time}}">
                        @error('delivery_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Order Number</label>
                        <input type="text" class="form-control @error('order_number') is-invalid @enderror" name="order_number" placeholder="Masukkan order_number" value="{{$PO->order_number}}">
                        @error('order_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="po">
                        <input type="hidden" name="id_tujuan" value="">
                        <input type="hidden" name="po_number" value="">
                        <input type="hidden" name="destination" value="">
                        <input type="hidden" name="default_id" value="">
                        <input type="hidden" name="issue_date" value="">
                        <input type="hidden" name="classname" value="">
                        <input type="hidden" name="currency" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button style="margin-left: 900px; margin-top:20px" type="submit" id="simpan" class="btn btn-primary">Simpan</button>
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
            const issue_date = $('#issue_date').val(date.toLocaleDateString('id-ID')+' - '+date.toLocaleTimeString('id-ID'))
        });
        //Ketika tambah item saja!!!!
            let id_tujuan = $('#id_tujuan').val()
            let po_num = $('#po_number').val()
            let destination = $('#destination').val()
            let default_id = $('#default_id').val()
            let issue_date = $('#issue_date').val()
            let classname = $('#classname').val()
            let currency = $('select#currency').val()
            $('[name="id_tujuan"]').val(id_tujuan)
            $('[name="po_number"]').val(po_num)
            $('[name="destination"]').val(destination)
            $('[name="default_id"]').val(default_id)
            $('[name="issue_date"]').val(issue_date)
            $('[name="classname"]').val(classname)
            $('[name="currency"]').val(currency)

        $('#unit_price').keyup(function(){
            let amount = ($('#unit_price').val()*$('#composition').val())*$('#qty').val()
            $('#amount').val(amount)
        })

    })

</script>


@endsection