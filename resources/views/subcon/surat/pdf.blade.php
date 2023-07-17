<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>SLIP SURAT JALAN</title>
        <style>
            .container {
                font-family: Arial, sans-serif;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 90%;
                max-width: 800px;
                background-color: #ffffff;
            }

            h1 {
                text-align: center;
            }

            table {
                margin-top: 24px;
                width: 100%;
                border-collapse: collapse;
            }

            table td,
            table th {
                padding: 10px;
                /* border: 1px solid #ccc; */
            }

            .row::after {
                content: "";
                display: table;
                clear: both;
            }

            .col {
                width: 50%;
                float: left;
            }

            p {
                margin: 0;
                font-weight: bold;
            }

            .target {
                margin-top: 20px;
            }
            .ttd {
                margin-top: 50px;
            }

            .field {
                font-weight: bold;
            }

            #td11,
            #td21,
            #td22,
            #td12 {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Surat Jalan</h1>
            <div class="row">
                <div id="sender" class="col">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td class="field">
                                    Sender:&nbsp; {{$from->pengirim}}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Receive :&nbsp; {{$from->penerima}}</td>
                            </tr>
                            <tr>
                                <td>
                                    PT.HIRUTA KOGYO INDONESIA Jalan Maligi X Lot
                                    V-6, Margakaya, Kec. Telukjambe Bar.,
                                    karawang, Jawa Barat 41361
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="detail" class="col">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td class="field" style="width: 25%">Date</td>
                                <td>&nbsp;:&nbsp; {{$from->tanggal}}</td>
                            </tr>
                            
                            {{-- <tr>
                                <td class="field">Schedule Time</td>
                                <td>&nbsp;:&nbsp;00:00</td>
                            </tr> --}}
                            
                            <tr>
                                <td class="field">Invoice</td>
                                <td>&nbsp;:&nbsp;--</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="target">
                <div class="row">
                    <div class="col">
                        <div id="td11">
                            <p>Send BY :</p>
                        </div>
                    </div>
                    <div class="col">
                        <div id="td21">
                            <p>Receiver :</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="target">
                <div class="row">
                    <div class="col">
                        <div id="td12" class="ttd">
                            (----------------------------)
                        </div>
                    </div>
                    <div class="col">
                        <div id="td22" class="ttd">
                            (----------------------------)
                        </div>
                    </div>
                </div>
            </div>
            
            <table id="table" class="table" border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>PO No</th>
                        <th>Material</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($details as $detail)
                    <tr>
                        <!--- number -->
                        <td>{{$no++}}</td>
                        <!--- PO NO -->
                        <td>{{$detail->po_number}}</td>
                        <!--- Material -->
                        <td>{{$detail->part_no}}</td>
                        <!--- Deskripsi -->
                        <td>{{$detail->part_name}}</td>
                        <!--- qty -->
                        <td>{{$detail->order_qty}}</td>
                        <!-- unit -->
                        <td>{{$detail->unit}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td
                            colspan="4"
                            style="text-align: center; font-weight: bold"
                        >
                            Total
                        </td>
                        <!-- total qty -->
                        <td>{{$detail->order_qty}}</td>
                        <!-- total unit -->
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
</html>
