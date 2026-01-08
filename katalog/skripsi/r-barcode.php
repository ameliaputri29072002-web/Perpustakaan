<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barcode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .barcode-container {
            text-align: center;
            width: 210px;
            float: left;
            margin-right: 30px;
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .barcode {
            width: 180px; /* Set a fixed width for barcode */
            height: 50px; /* Set a fixed height to make sure it's not too tall */
            max-width: 100%; /* Ensure the barcode doesn’t stretch beyond container */
        }
    </style>
</head>
<body>

<?php
$jmlCetak = $_GET['jmlCetak']; // Number of barcodes to print
$barcode = $_GET['barcode'];   // Barcode value

require '../asset/barcodeGenerator/vendor/autoload.php';

$generator = new Picqer\Barcode\BarcodeGeneratorPNG();

// Loop to print the specified number of barcodes
for ($i = 1; $i <= $jmlCetak; $i++) { ?>
    <div class="barcode-container">
        <img class="barcode" src="data:image/png;base64,<?= base64_encode($generator->getBarcode($barcode, $generator::TYPE_CODE_128)); ?>" />
    </div>
<?php } ?>

<script>
    window.print();  // Trigger the print dialog
</script>

</body>
</html>
