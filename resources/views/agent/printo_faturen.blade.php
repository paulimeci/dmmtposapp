<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        /* Simplified styling */
        body {
            font-family: Arial, sans-serif;
            font-size: 8px; /* Adjust font size as needed */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px; /* Reduce margin */
        }
        th, td {
            border: 1px solid #000;
            padding: 3px; /* Reduce padding */
        }
        .text-center {
            text-align: center;
        }
        .text-end {
            text-align: right;
        }
        /* Set width for the row containing product names */
        tbody td:first-child {
            width: 50%; /* Adjust as needed */
        }
        /* Other styles as needed */
    </style>
</head>
<body>
<div class="page-content">
    <div class="invoice-title">
        <h4 class="font-size-16"><strong>Fatura nr # {{ $fatura_qe_do_printohet->nr_fature }}</strong></h4>
        <h4><img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo" height="18"/> DMMT POS</h4>
    </div>
    <hr>
    <div>
        <p>Date Fature: {{ date('d-m-Y',strtotime($fatura_qe_do_printohet->date)) }}</p>
        <p>Ore Fature: {{ date('H:i:s') }}</p>
        <p>Shitesi: {{$fatura_qe_do_printohet->agjenti->username}}</p>

    </div>
    <p>.</p>
    <p></p>
    <table>
        <thead>
        <tr>

        </tr>
        </thead>
        <tbody>
        @php $total_sum = '0'; @endphp
        @foreach($fatura_qe_do_printohet->fatura_detajet as $key => $details)
            <tr>
                <td colspan="2" class="text-left">{{ $details->produkti->name }}</td>
            </tr>
            <tr>
                <td class="text-left">{{ $details->sasia_shitur }} {{$details->produkti->unit->name}} x {{ $details->cmimi_nj }}</td>
                <td class="text-end">{{ $details->cmimi_total }}</td>
            </tr>
            @php $total_sum += $details->cmimi_total; @endphp
        @endforeach

        <tr>
            <td colspan="1" class="text-center"><strong>Shuma</strong></td>
            <td class="text-end">L{{ $total_sum }}</td>
        </tr>
        @if(isset($fatura_qe_do_printohet->zbritjet->shifra))
            <tr>
                <td colspan="1" class="text-center"><strong>Zbritja</strong></td>
                <td class="text-end"> {{ $fatura_qe_do_printohet->zbritjet->shifra ?? 0 }}% {{$total_sum*($fatura_qe_do_printohet->zbritjet->shifra)/100}}</td>
            </tr>
            <tr>
                <td colspan="1" class="text-center"><strong>Totali </strong></td>
                <td class="text-end">{{ $total_sum - (((($fatura_qe_do_printohet->zbritjet->shifra)/100)*$total_sum) ?? 0) }}</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
<script>
    // Add event listener for afterprint
    window.addEventListener("afterprint", function(event) {
    });

    // Optionally, you can add a script to trigger printing
    window.onload = function() { window.print(); }
</script>
</body>
</html>
