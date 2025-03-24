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
            font-size: 12px; /* Reduce font size to fit content */
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px; /* Reduced margin between tables */
            page-break-inside: avoid; /* Prevents table from breaking across pages */
        }
        th, td {
            border: 1px solid #000;
            padding: 6px; /* Reduced padding to make tables more compact */
            text-align: left;
            width: 50%; /* Ensures each column takes half the space */
            word-wrap: break-word;
        }
        .table-row-odd {
            background-color: #f9f9f9;
        }
        .table-row-even {
            background-color: #ffffff;
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
            margin-bottom: 2rem; /* Reduced margin */
        }
        .fw-bold {
            font-weight: bold;
        }
        h1, h4, h5 {
            text-align: center;
            margin-bottom: 10px; /* Increased margin for more space */
        }
        .header-info {
            display: flex;
            justify-content: space-between; /* Puts space between the two spans */
            align-items: center; /* Vertically centers the content */
            margin-bottom: 30px; /* Increased margin for more space */
        }
        .header-info span {
            font-size: 14px;
            font-weight: bold;
        }
        .header-info span:first-child {
            margin-right: auto; /* Pushes the first span to the left */
        }
        .header-info span:last-child {
            margin-left: auto; /* Pushes the second span to the right */
        }
        .table-header {
            font-size: 14px; /* Slightly bigger font size for headers */
        }
        .center-header {
            text-align: center; /* Center only this specific header */
        }
    </style>
</head>
<body>
@if (count($lista_blerjes) > 0)
    @php
        $firstItem = $lista_blerjes[0]; // Get the first item (arrays are zero-indexed)
    @endphp
    <table width="100%" style="border: none; border-collapse: collapse; margin-bottom: 0;"> <!-- Remove margin below the table -->
        <tr>
            <!-- Left Side: Text -->
            <td style="width: 30%; vertical-align: top; border: none;">
                <!-- Empty cell for spacing -->
            </td>

            <!-- Right Side: Image -->
            <td style="width: 40%; text-align: right; vertical-align: top; border: none;">
                <h1 class="text-center">Fatura: {{ $firstItem['nr_fature'] }}</h1>
            </td>
            <td style="width: 30%; text-align: right; vertical-align: top; border: none;">
                <!-- Set width to 150px and let height adjust automatically -->

            </td>
        </tr>
    </table>
    <div class="header-info" style="margin-top: 0;"> <!-- Remove margin above the div -->
        <span style="text-align: left;">Data: {{ date('d-m-Y', strtotime($firstItem['date'])) }}</span> <br>
        <span style="text-align: right;">Furnitori: {{ $firstItem['furnitori']['name'] }}</span><br>
        <span style="text-align: right;">Kategoria: {{ $firstItem['kategoria']['name'] }}</span><br>
    </div>

@else
    <p>No details found.</p>
@endif
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
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
    <tr style="font-size: 14px; font-weight: bold; background-color: #f2f2f2;"> <!-- Added styles -->
        <td colspan="3" style="padding: 10px;"> <!-- Increased padding and colspan -->
            TOTALI
        </td>
        <td colspan="2" style="padding: 10px;"> <!-- Increased padding and colspan -->
            {{ $totali }}
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
