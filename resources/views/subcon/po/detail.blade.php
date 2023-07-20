
<div class="xformdm">
    <div style="text-align: left" class="row">
                        <div class="col col-md-12 col-12 mt-2">
                            <div class="form-group">
                                <label for="password">PO Number</label>
                                <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number" name="po_number" placeholder="Masukkan po_number" value="{{$PO->po_number}}" readonly>
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
                                <input type="text" class="form-control @error('delivery_time') is-invalid @enderror" id="delivery_time" name="delivery_time" placeholder="Masukkan delivery_time" value="{{$PO->delivery_time}}" readonly>
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
                