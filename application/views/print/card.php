<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Out Kartu Peserta</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: 'Segoe UI', 'Corbel', Courier, monospace;
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 10pt;
        }

        .container {
            width: 21cm;
            /*display: relative;*/
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: start;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .col-7 {
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-5 {
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }

        .col-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .col-3 {
            flex: 0 0 25.333333%;
            max-width: 25.333333%;
        }

        .logo {
            width: 100%;
            margin-top: 8px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0.1rem;
            margin-bottom: 0.1rem;
            margin-block-start: 0px;
            margin-block-end: 0px;
            font-family: inherit;
            font-weight: bold;
            color: inherit;
        }

        .invoice-title {
            font-size: 3.5rem;
        }

        .text-right {
            text-align: end;
        }

        hr {
            margin-top: 0.6rem;
            margin-bottom: 0.6rem;
            border: 0;
            border-top: 1px solid rgb(0 0 0 / 82%)
        }

        table {
            border-collapse: collapse;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .tablestripped {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .tablebottom {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .mt-2 {
            margin-top: 3rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .tablestripped th {
            vertical-align: top;
            border-top: 1px solid #999797;
            border-bottom: 1px solid #999797;
        }

        .tablestripped td {
            vertical-align: top;
            border-top: 1px solid #999797;
        }

        .tablebottom td,
        .tablebottom th {
            vertical-align: top;
            border-top: 1px dashed #999797;
        }

        #line-bottom {
            border-top: 1px solid #999797;
        }

        .table-xl th {
            padding: 0.5rem;
        }

        .table-xl td {
            padding: 0.3rem;
        }

        .table-sm td,
        .table-sm th {
            padding: 0.2rem;
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .notes {
            padding-left: 25px;
            padding-top: 10px;
        }
        .card {
            width: 9.4cm;
            height: 6cm;
            background-image: url(<?= base_url('assets/images/contestant-card.jpg') ?>);
            background-repeat: no-repeat;
            background-size: contain;
            border: #0f6674 1px solid;
            margin-bottom: 5px;
            margin-right: 5px;
        }

        @page :first {
            size: legal;
            margin: 0;
        }

        @page {
            size: legal;
            margin: 8px 0;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <?php
        if ($data){
            $order = 0;
            foreach ($data as $row){
                $order++;
        ?>
                <div class="card">
                    <div class="row" style="margin-top: 60px">
                        <div class="col-8" style="padding-left: 20px;">
                            <h3><?= $row->name ?></h3>
                            <div>
                                <?= $row->address ?> <br><br>
                                <?= $row->school ?> <br><br>
                                <h3><?= $row->contest_name.' '.$category ?></h3>
                            </div>

                        </div>
                        <div class="col-3" style="padding-left: 6px">
                            <h2 style="font-size: 30pt; margin-top: 18px">
                                <?= $row->undian ?>
                            </h2>
                        </div>
                    </div>
                </div>
        <?php
                if ($order == 10 || $order == 20 || $order == 30 || $order == 40){
                    ?>
                    <p style="page-break-after: always;">&nbsp;</p>
        <?php
                }
            }
        ?>
    </div>
</div>
<script>
    window.print()
    window.onafterprint = function () {
        window.close()
    }
</script>
<?php
}else{
     echo "No data found";
}
?>
</body>

</html>