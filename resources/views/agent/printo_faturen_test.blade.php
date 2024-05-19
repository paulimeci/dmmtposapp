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
        <h4 class="font-size-16"><strong>Fatura nr # 771 </strong></h4>
        <h4><img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo" height="18"/> DMMT POS</h4>
    </div>
    <hr>
    <div>
        <p>Date Fature:09/04/2024</p>
        <p>Ore Fature:09:03:55 </p>
        <p>Shitesi: agjenti11</p>
        <p>Klienti: Paulin</p>

    </div>
    <p></p>
    <p></p>
    <table>
        <thead>
        <tr>

        </tr>
        </thead>
        <tbody>

            <tr>
                <td colspan="2" class="text-left">Patetina patos 20</td>
            </tr>
            <tr>
                <td class="text-left">3 cope x 30</td>
                <td class="text-end">90</td>
            </tr>
            <tr>
                <td colspan="2" class="text-left">Djath i bardhe baxho</td>
            </tr>
            <tr>
                <td class="text-left">1 KG x 750</td>
                <td class="text-end">750</td>
            </tr>


        <tr>
            <td colspan="1" class="text-center"><strong>Shuma</strong></td>
            <td class="text-end">L840</td>
        </tr>

        </tbody>
    </table>
</div>
<script>
    // Optionally, you can add a script to trigger printing
    window.onload = function() { window.print(); }
</script>
</body>
</html>
