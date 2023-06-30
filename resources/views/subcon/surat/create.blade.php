<div class="form mt-4">
    <form enctype="multipart/form-data" action="{{ route('subcon.surat.store') }}" method="POST">
        @csrf
        <div style="text-align: left" class="row">
            <input type="hidden" name="id_tujuan" value="1">
            @error('id_tujuan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="col col-md-12 col-12 mt-2">
                <div class="form-group">
                    <label for="password" style="margin-bottom: 5px;">PO Number</label>
                    <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number"
                        name="po_number" value="{{ old('po_number') }}">
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
                    <label for="password" style="margin-bottom: 5px;">Pengirim</label>
                    <input type="text" class="form-control @error('order_no') is-invalid @enderror"
                        {{-- id="order_no" name="order_no" value="{{ old('order_no') }}">
                                @error('order_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}} {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}} </div>
                </div>

                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="nama_barang" style="margin-bottom: 5px;">Tujuan Pengiriman</label>
                        <input type="text" class="form-control @error('part_name') is-invalid @enderror"
                            {{-- id="part_name" name="part_name" data-name="{{ old('part_name') }} ">
                                @error('part_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}} {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}} </div>
                    </div>

                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="password" style="margin-bottom: 5px;">Tanggal</label>
                            <input type="date" class="form-control @error('Tanggal') is-invalid @enderror"
                                id="Tanggal" name="Tanggal" value="{{ old('delivery_time') }}">
                            @error('delivery_time')
                                <span class="invalid-feedback" id="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>

                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="nama_barang" style="margin-bottom: 5px;">Part Name</label>
                            <input type="text" class="form-control @error('part_name') is-invalid @enderror"
                                id="part_name" name="part_name" data-name="{{ old('part_name') }} ">
                            @error('part_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>

                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="password" style="margin-bottom: 5px;">Order QTY</label>
                            <input type="number" class="form-control @error('order_qty') is-invalid @enderror"
                                id="order_qty" name="order_qty" value="{{ old('order_qty') }}">
                            @error('order_qty')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>

                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="password" style="margin-bottom: 5px;">Unit (Kg/Pc)</label>
                            <input type="text" class="form-control @error('payment') is-invalid @enderror"
                                {{-- id="payment" name="payment" value="{{ old('payment') }}">
                                @error('payment')
                                    <span class="invalid-feedback" id="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}} {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}} </div>
                        </div>




                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
    </form>
</div>

{{-- <script>
    $(document).ready(function() {
        $("#order_qty,#weight").keyup(function() {
            let qty = $("#order_qty").val();
            let weigth = qty;
            console.log(qty)
            $("#weight").val(`${qty}`);
        });
    })
</script> --}}

<style>
    /* Warna label/kolom saat normal */
    .form-group label,
    .form-control {
        background-color: #fff;
    }

    /* Warna label/kolom ketika disentuh */
    .form-group label:hover,
    .form-control:focus {
        color: #fff;
        background-color: #888;
    }
</style>

<script>
    // Script untuk menambahkan kelas 'active' pada label saat input diberi fokus
    document.addEventListener('DOMContentLoaded', function() {
        let formControls = document.querySelectorAll('.form-control');

        formControls.forEach(function(control) {
            control.addEventListener('focus', function() {
                this.previousElementSibling.classList.add('active');
            });

            control.addEventListener('blur', function() {
                this.previousElementSibling.classList.remove('active');
            });
        });
    });
</script>
