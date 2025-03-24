<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        @media print {
            body {
                margin: 0;
                padding: 10px;
            }
            table {
                page-break-inside: avoid !important;
            }
            tr {
                page-break-inside: avoid !important;
                page-break-after: auto !important;
            }
            thead {
                display: table-header-group !important;
            }
            tfoot {
                display: table-footer-group !important;
            }
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            word-wrap: break-word;
        }
        .text-center {
            text-align: center;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
        .mb-5 {
            margin-bottom: 2rem;
        }
        .fw-bold {
            font-weight: bold;
        }
        h1, h4, h5 {
            text-align: center;
            margin-bottom: 10px;
        }
        .header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header-info span {
            font-size: 14px;
            font-weight: bold;
        }
        .header-info span:first-child {
            margin-right: auto;
        }
        .header-info span:last-child {
            margin-left: auto;
        }
        .table-header {
            font-size: 14px;
        }
        .center-header {
            text-align: center;
        }
    </style>
</head>
<body>
@if (count($lista_blerjes) > 0)
    @php
        $firstItem = $lista_blerjes[0];
    @endphp
    <table width="100%" style="border: none; border-collapse: collapse; margin-bottom: 0;">
        <tr>
            <td style="width: 30%; vertical-align: top; border: none;"></td>
            <td style="width: 40%; text-align: right; vertical-align: top; border: none;">
                <h1 class="text-center">Fatura: {{ $firstItem['nr_fature'] }}</h1>
            </td>
            <td style="width: 30%; text-align: right; vertical-align: top; border: none;"></td>
        </tr>
        <tr>
            <td style="width: 33%; text-align: left; border: none;"><span style="text-align: left;">Data: {{ date('d-m-Y', strtotime($firstItem['date'])) }}</span></td>
            <td style="width: 33%; text-align: center; vertical-align: top; border: none;"><span style="text-align: right;">Furnitori: {{ $firstItem['furnitori']['name'] }}</span><br></td>
            <td style="width: 33%; text-align: right; vertical-align: top; border: none;"><span style="text-align: right;">Kategoria: {{ $firstItem['kategoria']['name'] }}</span></td>
        </tr>
    </table>
    <br>


@else
    <p>No details found.</p>
@endif
<table id="datatable" style="border-collapse: collapse; width: 100%;">
    <thead style="display: table-header-group;">
    <tr>
        <th>#</th>
        <th>Produkti</th>
        <th>Sasia blere</th>
        <th>Cmimi i blere</th>
        <th>Totali</th>
    </tr>
    </thead>
    <tbody>
    @php
        $totali=0;
    @endphp
    @foreach($lista_blerjes as $key=>$lb)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$lb->produkti->name}}</td>
            <td>{{$lb->sasia}}</td>
            <td>{{$lb->cmimi_blerjes}}</td>
            <td>{{$lb->sasia * $lb->cmimi_blerjes}}</td>
        </tr>
        @php $totali += $lb->sasia * $lb->cmimi_blerjes;@endphp
    @endforeach
    <tr style="font-size: 14px; font-weight: bold; background-color: #f2f2f2;">
        <td colspan="3" style="padding: 10px;">TOTALI</td>
        <td colspan="2" style="padding: 10px;">{{ $totali }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
