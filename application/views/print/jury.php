<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: 'Segoe UI', Courier, monospace;
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 11pt;
        }

        .container {
            width: 800px;
            display: relative;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
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

        h4 {
            font-size: 1.2rem;
        }

        .invoice-title {
            font-size: 3rem;
            color: #999797;
        }

        .card-title {
            font-size: 2.5rem;
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

        #table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 5px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            background-color: #65b73d;
            color: white;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .mt-1 {
            margin-top: 1rem;
        }

        .mt-2 {
            margin-top: 3rem;
        }

        .mb-1 {
            margin-bottom: 1rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
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

        .pt-2 {
            padding-top: 0.5rem;
        }

        .border {
            background-color: #181616;
            height: 1px;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .text-left {
            text-align: start;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-7">
                <img class="logo" src="<?= base_url() ?>assets/images/header-print-color.png" alt="">
            </div>
            <div class="col-5 text-right pt-2">
                <h1 class="invoice-title"><?= $jury ?></h1>
            </div>
        </div>
        <div class="border"></div>
        <div class="row">
            <?php
            $categoryText = [1 => 'PUTRA', 'PUTRI'];
            if ($status == 200) {
            ?>
                <div class="col-12 text-center <?= ($name == '') ? 'mb-1' : '' ?>">
                    <h4>DAFTAR PESERTA LOMBA <?= $contest ?> <?= $categoryText[$category] ?></h4>
                </div>
                <?php
                if ($name != '') {
                ?>
                    <div class="col-5 mb-1 text-bold mt-1">
                        JURI : UST. <?= $name ?>
                    </div>
                    <div class="col-7 mb-1 text-bold text-right mt-1">
                        PENILAIAN : <?= $evaluation ?>
                    </div>
                <?php } ?>
                <table id="table">
                    <thead>
                        <tr>
                            <th>UNDI</th>
                            <th>ID MMU</th>
                            <th>NAMA</th>
                            <?php
                            if($contest == 'CERDAS CERMAT' || $contest == 'RANGKING SATU' || $contest == 'MERANGKAI KALIMAT') {
                            ?>
                            <th>MMU</th>
                            <th>ALAMAT</th>
                            <?php }else{ ?>
                                <th>MMU</th>
                            <?php } ?>
                            <th>NILAI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $d) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $d->undian ?></td>
                                <td class="text-center"><?= $d->school_id ?></td>
                                <td><?= $d->name ?></td>
                                <td><?= $d->mmu ?></td>
                                <td><?= $d->village.', '.$d->city ?></td>
                                <td></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="col-12 text-center" style="color: red">
                    <h4 class="mb-1"><?= $data ?></h4>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <script>
        window.print()
        setTimeout(function() {
            window.close()
        }, 2000);
    </script>
</body>

</html>