<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <style>
        html{
            margin: 0;
        }
        body{
            max-width:210mm;
            font-family: 'Roboto Condensed';
            text-align: left;
            font-size: 11pt;
            line-height: 10pt;
            margin: 0;
        }
        .container{
            margin: 5mm;
            height: auto;
        }
        hr{
            border: 1px solid;
        }
        .caption{
            font-size: 11pt;
            text-align: left;
            margin: 2mm;
        }
        table{
            margin:0 auto;
            width: 100%;
        }
        td, tr, th{
            padding:0px;
        }
        h4, p{
            margin:0px;
        }
        .title {
            text-align: center;
            margin-bottom: 0px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title"><h3>TANDA BUKTI BARANG {{ $print[0]->type == 'in' ? 'MASUK' : 'KELUAR' }}</h3></div>
        <center><span style="margin-top: 0px; line-height: 5pt;">{{ $print[0]->invoice }}</span></center>
        <br>

        <table style="width: 100%; border-spacing: 5px">
            @if(($print[0]->supplier) == null)
            <tr>
                <td style="width: 10%;">Tanggal</td>
                <td style="width: 50%;">: {{ date('d F Y', strtotime($print[0]->date)) }}</td>
                <td style="width: 10%;">Dibuat</td>
                <td style="width: 30%;">: {{ $print[0]->user_name }}</td>
            </tr>
            <tr>
                <td>Ket.</td>
                <td colspan="3">: {{ $print[0]->desc }}</td>
            </tr>
            @else
            <tr>
                <td style="width: 10%;">Tanggal</td>
                <td style="width: 50%;">: {{ date('d F Y', strtotime($print[0]->date)) }}</td>
                <td style="width: 10%;">Supplier</td>
                <td style="width: 30%;">: {{ $print[0]->supplier }}</td>
            </tr>
            <tr>
                <td>Ket.</td>
                <td>: {{ $print[0]->desc }}</td>
                <td>Dibuat</td>
                <td>: {{ $print[0]->user_name }}</td>
            </tr>
            @endif
        </table>
        <hr>
        <table style="width: 100%; border-spacing: 3pt; text-align:left;">
            <tr>
                <td style="width: 5%; font-weight: bold;">No.</td>
                <td style="width: 25%; font-weight: bold;">Kode Barang</td>
                <td style="width: 55%; font-weight: bold;">Nama Barang</td>
                <td style="width: 15%; font-weight: bold;">Jumlah</td>
                <td style="width: 15%; font-weight: bold;">Kadaluarsa</td>
            </tr>
            <?php $no = 0 ?>
            @foreach($print as $data)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $data->product_code }}</td>
                <td>{{ $data->product_name }}</td>
                <td>{{ $data->qty }} {{ $data->product_unit }}</td>
                <td>{{ date('d-m-Y', strtotime($print[0]->expired)) }}</td>
            </tr>
            @endforeach
        </table>
        <hr>
        <br>
        Mengetahui,
    </div>
</body>
</html>
