<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        html{
            margin: 0;
        }
        body{
            max-width:210mm;
            font-family:Arial, Helvetica, sans-serif;
            text-align: left;
            font-size: 10pt;
            line-height: 11pt;
            margin: 0;
            margin-top: 5px;
        }
        .container{
            margin: 5mm;
            height: auto;
        }
        hr{
            border: 2px solid;
        }
        table{
            margin:0 auto;
            width: 100%;
            border-collapse: collapse;
        }
        td, tr, th{
            padding:3px;
            height: 14px;
        }
        h4, p{
            margin:0px;
        }
        .title {
            text-align: center;
        }
    </style>
</head>
<body>
    @php
        $max = 12;
    @endphp
    <div class="container">
        <table>
            <tr>
                <td style="width: 32%;">
                    @if(Auth::user()->branch_id == 1)
                    <b>Medical And Laboratory Equipment</b><br>
                    @else
                    <b>PT. MITRA DISTRINDO SEJATI</b><br>
                    NPWP: 73.433.858.5-505.000<br>
                    Jl. Taman Pahlawan No.32<br>
                    Salatiga - Jawa Tengah<br>
                    Phone: (0298) 314882<br>
                    @endif
                    <br>
                    <table border="0" style="padding:0;height:0;">
                        <tr>
                            <td style="padding:0;height:0;">No Faktur</td>
                            <td style="padding:0;height:0;">: {{ $print[0]->invoice }}</td>
                        </tr>
                        <tr>
                            <td style="padding:0;height:0;">Pembayaran</td>
                            <td style="padding:0;height:0;">: {{ $print[0]->payment_method }}</td>
                        </tr>
                        <tr>
                            <td style="padding:0;height:0;">Jth Tempo</td>
                            <td style="padding:0;height:0;">: {{ date('d F Y', strtotime($print[0]->due_date)) }}</td>
                        </tr>
                        <tr>
                            <td style="padding:0;height:0;">Sales</td>
                            <td style="padding:0;height:0;">: {{ $print[0]->user }}</td>
                        </tr>
                    </table>
                </td>
                <td style="text-align:center; vertical-align:bottom; width:35%">
                    <h2>INVOICE</h2>
                </td>
                <td style="width:32%; vertical-align:top;">
                    Salatiga, {{ date('d F Y', strtotime($print[0]->date)) }}<br>
                    <br>
                    Kepada Yth,
                    <br>
                    {{ $print[0]->company }}
                    <br>
                    {{ $print[0]->address }}, {{ $print[0]->city }}
                    <br>
                    Telp. {{ $print[0]->phone }}
                </td>
            </tr>
        </table>
        <table style="width: 100%; text-align:left; border-top:1px solid;">
            <tr style="border-bottom:1px solid;">
                <td style="width: 5%; font-weight: bold;">No.</td>
                <td style="width: 55%; font-weight: bold;">Nama Barang</td>
                <td style="width: 15%; font-weight: bold;">Banyaknya</td>
                <td style="width: 15%; font-weight: bold;">Harga (Rp.)</td>
                <td style="width: 15%; font-weight: bold;">Diskon (%)</td>
                <td style="width: 15%; font-weight: bold;">Total (Rp.)</td>
            </tr>
            <?php $no = 0 ?>
            @foreach($print as $data)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $data->product}}</td>
                <td>{{ $data->qty }} {{ $data->unit }}</td>
                <td>{{ strrev(implode('.',str_split(strrev(strval( $data->price )),3))) }}</td>
                <td>{{ $data->disc }} %</td>
                <td>{{ strrev(implode('.',str_split(strrev(strval( $data->total )),3))) }}</td>
            </tr>
            @php
                $max -= 1;
            @endphp
            @endforeach
            @for($i = 0;$i < $max; $i++)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endfor
        </table>
        <table style="width: 100%; border-top:1px solid;">
            <tr>
                <td style="vertical-align:top;" colspan="2" rowspan="@if(Auth::user()->branch_id <> 1) 7 @else 4 @endif">
                    Terbilang : {{ $terbilang }} Rupiah
                    <br><br>
                    @if(Auth::user()->branch_id <> 1)
                    <br>
                    Perhatian:
                    <br>
                    Pembayaran dengan Cheque/Giro kami anggap lunas setelah Cheque/Giro tersebut dapat kami uangkan.
                    <br>
                    @endif
                    <table border="0">
                        <tr>
                            <td style="width:50%;">Diterima,</td>
                            <td style="width: 50%;">Hormat Kami,</td>
                        </tr>
                    </table>
                </td>
                <td colspan="2" style="border: 1px solid;">Jumlah</td>
                <td style="border: 1px solid;">{{ strrev(implode('.',str_split(strrev(strval( $print[0]->subtotal )),3))) }}</td>
            </tr>
            @if(Auth::user()->branch_id <> 1)
            <tr>
                <td colspan="2" style="border: 1px solid;">PPH</td>
                <td style="width:20%;border: 1px solid;">{{ strrev(implode('.',str_split(strrev(strval( $pph )),3))) }}</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid;">DPP</td>
                <td style="border: 1px solid;">{{ strrev(implode('.',str_split(strrev(strval( $print[0]->subtotal )),3))) }}</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid;">PPN 11% x DPP</td>
                <td style="border: 1px solid;">{{ strrev(implode('.',str_split(strrev(strval( $print[0]->total_ppn )),3))) }}</td>
            </tr>
            @endif  
            <tr>
                <td colspan="2" style="border: 1px solid;">Diskon</td>
                <td style="border: 1px solid;">{{ $print[0]->total_disc}} %</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid;">Biaya Pengiriman</td>
                <td style="border: 1px solid;">{{ strrev(implode('.',str_split(strrev(strval( $print[0]->delivery )),3))) }}</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid;"><b>Total</b></td>
                <td style="border: 1px solid;"><b>{{ strrev(implode('.',str_split(strrev(strval( $print[0]->grandtotal )),3))) }}</b></td>
            </tr>
        </table>
    </div>
</body>
</html>
