<div class="form mt-4">
    <form enctype="multipart/form-data" action="{{ route('subcon.surat.store') }}" method="POST">
        @csrf
        <div style="text-align: left" class="row">
            <div class="col col-md-12 col-12 mt-2">
                <div class="form-group">
                    <label for="basic-usage" style="margin-bottom: 5px;">No Po</label>
                    <select class="form-select" id="basic-usage" data-placeholder="Pilih No Po" name="po_number">
                        <option></option>
                        @foreach ($po as $data)
                        <option value="{{$data->po_number}}">{{$data->po_number}}</option>
                        @endforeach
                    </select>
                    <script>
                        $('#basic-usage').select2({
                            dropdownParent: $('#exampleModalCenter'),
                            theme: "bootstrap-5",
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                                '100%' : 'style',
                            placeholder: $(this).data('placeholder'),
                        });

                        $('#basic-usage').on('change', function () {
                            handleSelectChange();
                        });

                        function handleSelectChange() {
                            // Mendapatkan nilai dari tag <select>
                            var selectedValue = $('#basic-usage').val();

                            // Melakukan permintaan AJAX
                            $.ajax({
                                url: '/subcon/surat/create/' + selectedValue,
                                method: 'GET',
                                success: function (response) {
                                    $('#part_no').val(response.data.part_no);
                                    $('#part_name').val(response.data.part_name);
                                    $('#order_qty').val(response.data.order_qty);
                                    $('#unit').val(response.data.unit);

                                    // Lanjutkan mengatur nilai untuk input lainnya sesuai dengan kolom yang ada di database
                                },
                                error: function () {
                                    console.log('Terjadi kesalahan dalam permintaan AJAX.');
                                }
                            });
                        }
                    </script>
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
            </div>

            <div class="col col-md-12 col-12 mt-2">
                <div class="form-group">
                    <label for="password" style="margin-bottom: 5px;">Tanggal Pengiriman</label>
                    <input type="date" class="form-control" id="Tanggal" name="tanggal" required>
                </div>
            </div>

            <div class="col col-md-12 col-12 mt-2">
                <div class="form-group">
                    <label for="password" style="margin-bottom: 5px;">Pengirim</label>
                    <input type="text" class="form-control disabled-input" value="{{ Auth::user()->nama }}" name="pengirim" readonly>

                </div>

                <div class="col col-md-12 col-12 mt-2">
                    <div class="form-group">
                        <label for="tujuan" style="margin-bottom: 5px;">Tujuan Pengiriman</label>
                        <input type="text" class="form-control disabled-input" id="tujuan" name="penerima"
                            value="{{$tujuan[0]->username;}}" readonly>
                    </div>

                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="part_no" style="margin-bottom: 5px;">Part No</label>
                            <input type="text" class="form-control disabled-input" id="part_no" name="part_no" readonly>
                        </div>
                    </div>

                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="nama_barang" style="margin-bottom: 5px;">Part Name</label>
                            <input type="text" class="form-control disabled-input"
                                id="part_name" name="part_name" readonly>

                        </div>
                    </div>

                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="password" style="margin-bottom: 5px;">Order QTY</label>
                            <input type="number" class="form-control disabled-input" id="order_qty" name="qty" readonly>
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    </div>

                    <div class="col col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label for="unit" style="margin-bottom: 5px;">Unit (Kg/Pc)</label>
                            <input type="text" class="form-control disabled-input" id="unit" name="unit" readonly>
                        </div>
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
    .disabled-input {
    background-color: #f5f5f5;
    cursor: not-allowed;
  }
</style>

<script>
    // Script untuk menambahkan kelas 'active' pada label saat input diberi fokus
    document.addEventListener('DOMContentLoaded', function () {
        let formControls = document.querySelectorAll('.form-control');

        formControls.forEach(function (control) {
            control.addEventListener('focus', function () {
                this.previousElementSibling.classList.add('active');
            });

            control.addEventListener('blur', function () {
                this.previousElementSibling.classList.remove('active');
            });
        });
    });
</script>
