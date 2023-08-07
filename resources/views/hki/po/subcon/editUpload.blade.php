@extends('layouts.templateBaru',['title'=>'Edit PO Subcon'])
@section('content')
@section('content')

<div class="container">
    <div class="card shadow-sm">
        <div class="xformdm">
            <div class="header bg-primary text-light pb-3 pt-4 mb-3 rounded shadow">
                <center>
                    <h3>Edit PO Subcon</h3>
                </center>
            </div>

            <div class="text-center mt-4" style="margin-left: 800px">
              </div>

            <div class="form mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group text-start">
                                <label for="id_tujuan" class="text-left fw-bold">Tujuan Supplier (ID Perusahaan)</label>
                                <input type="text" class="form-control @error('Tujuan') is-invalid @enderror" id="id_tujuan" placeholder="Masukkan Tujuan" value="{{$POById->id_tujuan_po}}">
                                @error('id_tujuan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3 text-start">
                                <label for="po_number" class="fw-bold">PO Number</label>
                                <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number" placeholder="Masukkan po_number" value="{{$POById->po_number}}">
                                @error('po_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3 text-start">
                                <label for="destination" class="fw-bold">Tujuan Pengiriman (Delivery Destination)</label>
                                <select id="destination" class="form-control @error('destination') is-invalid @enderror">
                                    <option>-- Pilih Tujuan Pengiriman --</option>
                                    @foreach($hki as $data)
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
                            <div class="form-group text-start">
                                <label for="default_id" class="fw-bold">ID Default Supplier</label>
                                <input type="text" class="form-control @error('default_id') is-invalid @enderror" id="default_id" placeholder="Masukkan default_id" value="{{$POById->id_tujuan_po}}">
                                @error('default_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3 text-start">
                                <label for="issue_date" class="fw-bold">Issue Date</label>
                                <input type="text" class="form-control @error('issue_date') is-invalid @enderror" id="issue_date" placeholder="Masukkan issue_date">
                                @error('issue_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-start">
                                <label for="class" class="fw-bold">Class</label>
                                <input type="text" class="form-control @error('class') is-invalid @enderror" id="classname" placeholder="Masukkan class" value="{{$POById->class}}">
                                @error('classname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3 text-start">
                                <label for="currency" class="fw-bold">Currency</label>
                                <select id="currency" class="form-control @error('currency') is-invalid @enderror">
                                    <option>-- Pilih Currency Code --</option>
                                    <option>IDR</option>
                                    <option>EUR</option>
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

    <div class="card mt-3 shadow-sm">
        <form id="formPO" method="POST" action="{{url('hki/po/subcon/update/'.$POById->id_po)}}" enctype="multipart/form-data">
            @csrf
        @php
            $no = 1;
        @endphp
        @foreach ($PO as $item)
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group text-start">
                        <label for="part_no" class="fw-bold">Part No.</label>
                        <input type="text" id="part_no" class="form-control @error('part_no') is-invalid @enderror" name="part_no[]" placeholder="Masukkan part_no" readonly value="{{$item->part_no}}">
                        @error('part_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 text-start">
                        <label for="qty" class="fw-bold">QTY</label>
                        <input type="text" class="form-control @error('qty') is-invalid @enderror" id="qty{{$no}}" name="qty[]" placeholder="Masukkan qty" readonly value="{{$item->order_qty}}">
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 text-start">
                        <label for="composition" class="fw-bold">Composition</label>
                        <input type="text" class="form-control @error('composition') is-invalid @enderror" id="composition{{$no}}" name="composition[]" placeholder="Masukkan composition" readonly value="{{$item->composition}}">
                        @error('composition')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group text-start">
                        <label for="" class="fw-bold">Part Name</label>
                        <input type="text" class="form-control @error('part_name') is-invalid @enderror" name="part_name[]" placeholder="Masukkan part_name" readonly value="{{$item->part_name}}">
                        @error('part_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 text-start">
                        <label for="" class="fw-bold">Unit</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit[]" placeholder="Masukkan unit" readonly value="{{$item->unit}}">
                        @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 text-start">
                        <label for="" class="fw-bold">Amount</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount{{$no}}" name="amount[]" placeholder="Masukkan amount" readonly value="{{$item->amount}}">
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group text-start" data-index="{{$no}}">
                        <label for="" class="fw-bold">Unit Price</label>
                        <input type="text" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price{{$no}}" name="unit_price[]" placeholder="Masukkan unit_price" readonly value="{{$item->unit_price}}">
                        @error('unit_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3 text-start">
                        <label for="" class="fw-bold">Order Number</label>
                        <input type="text" class="form-control @error('order_number') is-invalid @enderror" name="order_number[]" placeholder="Masukkan order_number" readonly value="{{$item->order_number}}">
                        @error('order_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 text-start">
                        <label for="" class="fw-bold">Delivery Date</label>
                        <input type="date" class="form-control @error('delivery_time') is-invalid @enderror" name="delivery_time[]" placeholder="Masukkan delivery_time" readonly value="{{$item->delivery_time}}">
                        @error('delivery_time')
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
                        <input type="hidden" name="delivery_date" value="">
                        <input type="hidden" name="classname" value="">
                        <input type="hidden" name="currency" value="">
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @php
            $no++;
        @endphp
        @endforeach
    </div>
    <button style="margin-left: 1000px; margin-bottom:70px; margin-top:20px" type="submit" id="simpan" class="btn btn-primary shadow fixed-bottom">Simpan</button>
</form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#destination,#currency').on('change', function(){
            let currency = $('select#currency').val()
            $('[name="currency"]').val(currency)
            //edit tujuan
            let id_tujuan = $('#id_tujuan').val()
            $('[name="id_tujuan"]').val(id_tujuan)
            //edit default id
            let id_default = $('#default_id').val()
            $('[name="default_id"]').val(id_default)
            //edit class
            let classname = $('#classname').val()
            $('[name="classname"]').val(classname)
            //edit destination
            let destination = $('#destination').val()
            $('[name="destination"]').val(destination)
            let delivery_date = $('#delivery_date').val()
            $('[name="delivery_date"]').val(delivery_date)

        });

        let id_tujuan = $('#id_tujuan').val()
        $('[name="id_tujuan"]').val(id_tujuan)
        let id_default = $('#default_id').val()
        $('[name="default_id"]').val(id_default)

        let classname = $('#classname').val()
        $('[name="classname"]').val(classname)

        let destination = $('#destination').val()
        $('[name="destination"]').val(destination)

        let issue_date = $('#issue_date').val()
        $('[name="issue_date"]').val(issue_date)
        // console.log(issue_date)
        let po_num = $('#po_number').val()
        $('[name="po_number"]').val(po_num)

        let currency = $('select#currency').val()
        $('[name="currency"]').val(currency)

        let delivery_date = $('#delivery_date').val()
        $('[name="delivery_date"]').val(delivery_date)

        $('#po_number').keyup(function(){
            date = new Date();
            $('#issue_date').val(date.toLocaleDateString('id-ID')+' - '+date.toLocaleTimeString('id-ID'))
            $('[name="issue_date"]').val(date.toLocaleDateString('id-ID')+' - '+date.toLocaleTimeString('id-ID'))
            // console.log(date_issue[0])

            let po_num = $('#po_number').val()
            $('[name="po_number"]').val(po_num)
        });
        $('#destination').change(function(){
            date = new Date();
            $('#issue_date').val(date.toLocaleDateString('id-ID')+' - '+date.toLocaleTimeString('id-ID'))
            $('[name="issue_date"]').val(date.toLocaleDateString('id-ID')+' - '+date.toLocaleTimeString('id-ID'))
        });
        $('[name="unit_price[]"],[name="composition[]"],[name="qty[]"],[name="amount[]"]').keyup(function(){
            const update = $('#formPO').find("input[type=text]");
            update.each(function(i) {
                let amount = ($('#unit_price'+i+'').val()*$('#composition'+i+'').val())*$('#qty'+i+'').val()
                console.log(amount)
                $('#amount'+i+'').val(amount)
            })
        })

    })

</script>


@endsection