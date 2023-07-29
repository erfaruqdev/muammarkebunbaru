<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: 'Courier New', Courier, monospace;
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 11pt;
        }

        .container {
            width: 19cm;
            display: block;
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

        .invoice-title {
            font-size: 3.5rem;
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

        .mt-1 {
            margin-top: 1rem;
        }

        .mt-2 {
            margin-top: 3rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .tablestripped td,
        .tablestripped th {
            vertical-align: top;
            border-top: 1px solid #999797;
        }

        .tablebottom td,
        .tablebottom th {
            vertical-align: top;
            border-top: 1px dashed #999797;
        }

        .table-xl td,
        .table-xl th {
            padding: 0.5rem;
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

        .logo {
            width: 450px;
        }
        
        .border {
            background-color: #181616;
            height: 1px;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    if ($data) {
    ?>
        <div class="container">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td>
                            <img class="logo" src="<?= base_url() ?>assets/images/header-print.png" alt="">
                        </td>
                        <td>
                            <h1 style="text-align: right;" class="invoice-title">INVOICE</h1>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="border"></div>
            <table class="table">
                <tr>
                    <td>ID MMU</td>
                    <td><?= $data->id ?></td>
                    <td></td>
                    <td>Metode</td>
                    <td><?= $data->method ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><b><?= $data->name ?></b></td>
                    <td></td>
                    <td>Nomor</td>
                    <td><?= $data->invoice ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?= $data->village ?>, <?= $data->city ?></td>
                    <td></td>
                    <td>Tanggal</td>
                    <td><?= datetimeIDFormat($data->created_at) ?></td>
                </tr>
            </table>
            <div class="row">
                <div class="col-12">
                    <table class="tablestripped table-xl" style="margin-bottom: 0px">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KETERANGAN</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-bold">
                                <td class="text-center">1</td>
                                <td>Biaya Registrasi Peserta</td>
                                <td class="text-center">Rp. <?= number_format($data->amount, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="border"></div>
            <table class="mb-2">
                <tbody>
                    <tr>
                        <td style="width: 60%">
                            <b>Terbilang :</b> <br>
                            <i><?= ucwords(terbilang($data->amount)) ?> Rupiah</i>
                        </td>
                        <td class="text-center" style="width: 40%">
                            Kebun Baru, <?= datetimeIDDate($data->created_at) ?> <br>
                            Bendahara <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Catatan :</b> <br>
                            <i>
                                Invoice ini adalah bukti pembayaran yang SAH.
                                Mohon simpan dengan baik.
                            </i>
                        </td>
                        <td class="text-center">
                            <p style="margin-top: 60px;">
                                <u><b>ABDUR ROUF</b></u>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-12 text-center">
                    <span style="font-style: italic; font-size: 8pt; color: #080000">
                        -------------------------------------------------Potong di sini-------------------------------------------------
                    </span>
                </div>
            </div>
            <div class="border"></div>
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td>
                            <img class="logo" src="<?= base_url() ?>assets/images/header-print.png" alt="">
                        </td>
                        <td class="text-right" style="padding-right: 10px">
                            <h1 class="card-title" style="text-align: right;">KARTU CHECKIN</h1>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="border"></div>
            <table class="table">
                <tr>
                    <td style="width: 40%">
                        <img width="80%" src="<?= base_url() ?>assets/images/qrcodes/<?= $data->id ?>.png" alt="">
                    </td>
                    <td style="width: 60%">
                        <p><?= $data->id ?></p>
                        <h6><?= $data->name ?></h6>
                        <p><?= $data->village ?>, <?= $data->city ?></p>
                    </td>
                </tr>
            </table>
            <div class="row">
                <div class="col-12 text-center">
                    <span style="font-style: italic; font-size: 8pt; color: #080000">
                        -------------------------------------------------Potong di sini-------------------------------------------------
                    </span>
                </div>
            </div>
            <div class="border"></div>
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td>
                            <img class="logo" src="<?= base_url() ?>assets/images/header-print.png" alt="">
                        </td>
                        <td class="text-right" style="padding-right: 10px">
                            <h1 class="card-title" style="text-align: right;">KARTU CHECKIN</h1>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="border"></div>
            <table class="table">
                <tr>
                    <td style="width: 40%">
                        <img width="80%" src="<?= base_url() ?>assets/images/qrcodes/<?= $data->id ?>.png" alt="">
                    </td>
                    <td style="width: 60%">
                        <p><?= $data->id ?></p>
                        <h6><?= $data->name ?></h6>
                        <p><?= $data->village ?>, <?= $data->city ?></p>
                    </td>
                </tr>
            </table>
        </div>
    <?php
    }
    ?>
</body>

</html>