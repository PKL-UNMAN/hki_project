<html>
<head>
    <title> KOP SURAT </title>
    <style type= "text/css">
    .container {
                font-family: Arial, sans-serif;
                width: 100%;
                background-color: #ffffff;
            }

            h1 {
                text-align: center;
            }
            .header {
                  border-bottom : 3px solid black;
                   padding: 0px;
                   margin-top:0em;
                   line-height: 1.5
                   }

            table {
                margin-top: 24px;
                width: 100%;
                border-collapse: collapse;
            }

            table td,
            table th {
                padding: 5px;
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


            #td11,
            #td21,
            #td22,
            #td12,
            .judul, .header {
                text-align: center;
                padding:0;
            }
            .identitas{
                  font-size:12px;
            }

     </style >
</head>
<body>
<div class = "container">
     <table class="header" width="100%">
           <tr>
                 <td style="width:100%">
                       <h2 style="font-weight:100"><b>PT HIRUTA KOGYO INDONESIA</b></h2>
                       <p style="font-size:14px"> Jalan Maligi X Lot V-6, Margakaya</p>
                       <p style="font-size:14px">Kec. Telukjambe Barat, Karawang. Phone : {{$hki->telepon}}, Fax : {{$hki->fax}}</p>
                 </td>
            </tr>
     </table>
     <div class="judul">
      <h4 style="font-weight:bold" >PURCHASE ORDER</h4>
      </div>

      <div class="identitas">
            <div class="row">
                <div id="sender" class="col">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td class="field">
                                    To &nbsp;&nbsp;&nbsp;:&nbsp; {{$from->nama}}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Tel &nbsp;&nbsp;:&nbsp; {{$from->telepon}}</td>
                            </tr>
                              <tr>
                                <td class="field">Fax &nbsp;:&nbsp; {{$from->fax}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="detail" class="col">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td class="field" style="width: 25%">PO No</td>
                                <td>&nbsp;:&nbsp; {{$from->po_number}}</td>
                            </tr>            
                            <tr>
                                <td class="field">Issue Date</td>
                                <td>&nbsp;:&nbsp;{{$from->issue_date}}</td>
                            </tr>
                              <tr>
                                <td class="field">Term of Payment</td>
                                <td>&nbsp;:&nbsp;--</td>
                            </tr>
                              <tr>
                                <td class="field">Currency</td>
                                <td>&nbsp;:&nbsp;IDR</td>
                            </tr>
                             <tr>
                                <td class="field">Delivery Destination</td>
                                <td>&nbsp;:&nbsp;{{$sucon->nama}}</td>
                            </tr>
                            <tr >
                                <td class="field">&nbsp;&nbsp;</td>
                                <td>{{$sucon->alamat}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
      </div>


<div class="container" style="font-size:12px">
      <table id="table" class="table" border="1">
            <tr>
                  <th class="th"><p>No</p></th>
                  <th class="th"><p>Part No</p></th>
                  <th class="th"><p>Description</p></th>
                  <th class="th"><p>QTY<br>pcs</p></th>
                  <th class="th"><p>QTY<br>(PC) </p></th>
                  <th class="th"><p>UOM</p></th>
                  <th class="th"><p>Price per Unit</p></th>
                  <th class="th"><p>Delivery Date</p></th>
                  <th class="th" style="width:10%"><p>Amount</p></th>
                  <th class="th" style="width:10%"><p>Order No</p></th>
            </tr>
            @php
            $no=1
            @endphp
            @foreach ($group as $item)
                  <tr >
                        <td style="text-align:center;width:5%" class="td"><p>{{$no++}}</p></td>
                        <td class="td" style="width:10%"><p>{{$item->part_no}}</p></td>
                        <td class="td" style="width:20%"><p>{{$item->part_name}}</p></td>
                        <td class="td"><p>{{$item->order_qty}}</p></td>
                        <td class="td"><p>@currency($item->composition)</p></td>
                        <td class="td"><p>{{$item->unit}}</p></td>
                        <td class="td"><p>@currency($item->unit_price)</p></td>
                        <td class="td" style="width:10%"><p>&nbsp;{{$item->delivery_time}}&nbsp;</p></td>
                        <td class="td" style="width:10%"><p>&nbsp;@currency($item->amount)&nbsp;</p></td>
                        <td class="td"><p>&nbsp;{{$item->order_number}}&nbsp;</p></td>
                  </tr>
            @endforeach
            <tr>
                  <td colspan="6"></td>
                  <td colspan="2" class="text-left">Subtotal</td>
                  <td style="border:1px solid black;text-align:right;">@currency($sum_amount)</td>
                  <td></td>

            </tr>
            <tr>
                  <td colspan="6"></td>
                  <td colspan="2" class="text-left">Discount</td>
                  <td style="border:1px solid black;text-align:right;">0.00</td>
                  <td></td>   
            </tr>
            <tr>
                  <td colspan="6"></td>
                  <td colspan="2" class="text-left">Vat 11.00%</td>
                  <td style="border:1px solid black;text-align:right;">
                  @currency($pajak = $sum_amount*11/100)</td>
                  <td></td>
            </tr>
            <tr>
                  <td colspan="6"></td>
                  <td colspan="2" class="text-left"><b>Grand Total</b></td>
                  <td style="border:1px solid black;text-align:right;">@currency($sum_amount+$pajak)</td>
                  <td></td>

            </tr>
      </table>
</div>

      <div class="ttd mt-1" style="font-size:12px;font-weight:bold;">
           <table>
            <tr>
                  <td>AUTHORIZED SIGNATURE & DATE</td>
                  <td style="width:60%"></td>
                  <td>PT HIRUTA KOGYO INDONESIA</td>
            </tr>
            <tr>
                  <td style="height:75px"></td>
            </tr>
            <tr>
                  <td>................................</td>
                  <td style="width:60%"></td>
                  <td>MASAHIRO TAKASUGI</td>
            </tr>
            </table>         
      </div>
      </div>
</div>



</body>
</html>