<html>
<head>
    <title> KOP SURAT </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <style type= "text/css">
    *{
            margin-top: 20px;
        }
        
    body {font-family: Arial, Helvetica, sans-serif; background-color : #ffffff }
    .rangkasurat {margin:auto ;background-color : #fff;padding: 10px}
   .header {border-bottom : 3px solid black; padding: 0px;margin-top:0em;line-height: 1.5}
    .tengah {text-align : center;font-size:16px;}
    .judul{
      text-align:center;line-height:5px;font-size:14px;padding-top:25px;}
     .isi{
      margin-left:2em;margin-top:1em;margin-right:2em;
     }
     .isi p{
      font-size:12px;
     }

     .list{
      margin-top:1em;
     }

     .list, .th, .td {
      border: 1px solid black;
      border-collapse: collapse;
      font-size:12pt;
      margin-top:1.5em;
      margin-left:0.4em;
      }

      .kegiatan{
            margin-top:1.5em;
      }
      .persyaratan{
            margin-top:1.5em;
            line-height:1;
      }

      h6{
            font-size:12pt;
            font-weight:400;
            line-height:1.5;
      }
      p{
            font-size:12pt;
      }

      .from{
            margin-left:auto;
            margin-right:auto;
            line-height:0;
      }

      .from1{
            line-height:0;
            word-break:break-all;
      }

      .staff{
            line-height:1;
      }
      
      .page-break {
            page-break-after: always;
      }

     </style >
</head>
<body>




<div class = "rangkasurat">
     <table class="header" width="100%">
           <tr>
                 <td style="width:100%" class = "tengah">
                       <h2 style="line-height:40px;font-weight:100"><b>PT HIRUTA KOGYO INDONESIA</b></h2>
                       <h4 style="font-weight:1;line-height:20px;font-size:14px"> Jalan Maligi X Lot V-6, Margakaya</h4>
                       <h4  style="font-weight:1;line-height:10px;font-size:14px">Kec. Telukjambe Barat, Karawang. Phone : {{$hki->telepon}}, Fax : {{$hki->fax}}</h4>
                       {{-- <h4 style="font-weight:1;line-height:20px;">Telp. (0260) 417658 Laman: <span style="color:blue">https://www.polsub.ac.id</span></h4> --}}
                 </td>
            </tr>
     </table>
     <div class="judul">
      <h4 style="font-weight:bold" >PURCHASE ORDER</h4>
      </div>

      <div class="identitas">
            <div class="row">
                  <div class="col-md-12">
                        <table  width="100%" class="from mt-2">
                              <tr style="height:50px;vertical-align:top">
                                    <td style="width:20%"><p>To</p></td>
                                    <td style="width:2%"><p>:</p></td>
                                    <td style="width:28%"><p>{{$from->nama}}</p></td>

                                    <td style="width:10"></td>

                                    <td style="width:20%"><p>PO No</p></td>
                                    <td style="width:2%"><p>:</p></td>
                                    <td style="width:78%"><p>{{$from->po_number}}</p></td>
                                    
                                    
                              </tr>
                              <tr>
                                    <td style="width:20%"></td>
                                    <td style="width:2%"></td>
                                    <td style="width:28%"></td>
                                    <td></td>

                                    <td style="width:20%"><p>Issue Date</p></td>
                                    <td style="width:2%"><p>:</p></td>
                                    <td style="width:78%"><p>{{$from->issue_date}}</p></td>
                              </tr>
                              <tr>
                                    <td style="width:20%"><p>Tel</p></td>
                                    <td style="width:2%"><p>:</p></td>
                                    <td style="width:78%"><p>{{$from->telepon}}</p></td>
                                    <td></td>
                                    <td style="width:50%"><p>Term of Payment</p></td>
                                    <td style="width:2%"><p>:</p></td>
                                    <td style="width:28%"></td>

                              </tr>
                              <tr>
                                    <td style="width:20%"><p>Fax</p></td>
                                    <td style="width:2%"><p>:</p></td>
                                    <td style="width:78%"><p>{{$from->fax}}</p></td>

                                    <td></td>

                                    <td style="width:20%"><p>Currency</p></td>
                                    <td style="width:2%"><p>:</p></td>
                                    <td style="width:78%"><p>IDR</p></td>
                              </tr>
                              <tr>
                                    <td style="width:20%"></td>
                                    <td style="width:2%"></td>
                                    <td style="width:28%"></td>
                                    <td></td>

                                    <td style="width:20%"><p>Delivery Destination</p></td>
                                    <td style="width:2%"><p>:</p></td>
                                    <td style="width:78%"></td>
                              </tr>
                              <tr>
                                    <td style="width:20%"></td>
                                    <td style="width:2%"></td>
                                    <td style="width:78%"></td>
                              </table>
                              <p style="margin-left:50%">PT. HIRUTA KOGYO INDONESIA<br>Maligi X Lot.V-6 Kawasan Industri KIIC Desa Margakaya, Kecamatan Telukjambe Barat Kabupaten Karawang,<br>
                              TEL: 0267 648 2020 / FAX: 0267 845 6464</p>      
                  </div>

            </div>
      </div>

      <div class="isi" style="font-size:10px">
      

      <table width="100%" class="text-center">
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

      
      <div class="ttd mt-4">
           <table>
            <tr>
                  <td>Please Sign to confirm order and return to us</td>
                  <td style="width:55%"></td>
                  <td></td>
            </tr>
            <tr>
                  <td>AUTHORIZED SIGNATURE & DATE</td>
                  <td style="width:100%"></td>
                  <td>PT HIRUTA KOGYO INDONESIA</td>
            </tr>
            <tr>
                  <td style="height:75px"></td>
            </tr>
            <tr>
                  <td>................................</td>
                  <td style="width:100%"></td>
                  <td>MASAHIRO TAKASUGI</td>
            </tr>
            
      
            </table>         
      </div>
    
      

      </div>
</div>



</body>
</html>