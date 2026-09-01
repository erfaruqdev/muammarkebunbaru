<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">

    <style>
        * {
            font-family: 'Segoe UI', 'Corbel', Courier, monospace;
            font-size: 12pt;
        }

        .container {
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

        .col-7 {
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
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

        table {
            border-collapse: collapse;
        }

        .tablestripped {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .tablestripped th {
            vertical-align: middle;
            border-top: 1px solid #999797;
            border-bottom: 1px solid #999797;
        }

        .tablestripped td {
            vertical-align: top;
            border-top: 1px solid #999797;
        }

        .table-xl th {
            padding: 0.5rem;
        }

        .table-xl td {
            padding: 0.3rem;
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .mb-1 {
            margin-bottom: 1rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .border {
            background-color: #181616;
            height: 1px;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .border-l {
            border-left: 1px solid #999797;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-7">
            <img
                class="logo"
                src="<?= base_url() ?>assets/images/header-print-color.png"
                alt=""
            >
        </div>
    </div>

    <div class="border"></div>

    <div class="row">
        <div class="col-12">
            <?php if ($status == 200) { ?>

                <h6 class="text-center mb-1">
                    REKAP POINT KEJUARAAN MUAMMAR 1448 KEBUN BARU
                    <br>
                    KATEGORI <?= $category == 1 ? 'PUTRA' : 'PUTRI' ?>
                </h6>

                <table class="tablestripped table-xl">
                    <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th>MADRASAH</th>
                        <th>PJGB</th>
                        <th>GB</th>
                        <th class="text-center">
                            JUMLAH LOMBA
                        </th>
                        <th class="text-center">
                            JUMLAH POINT
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;

                    foreach ($data as $d) {
                        ?>
                        <tr>
                            <td class="text-center">
                                <?= $no++ ?>
                            </td>

                            <td>
                                <?= $d->madrasah ?>
                            </td>

                            <td>
                                <?= $d->pjgb ?>
                            </td>

                            <td>
                                <?= $d->gb ?>
                            </td>

                            <td class="text-center">
                                <?= $d->jumlah_contest_dijuarai ?>
                            </td>

                            <td class="text-center text-bold border-l">
                                <?= $d->jumlah_point ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>

            <?php } else { ?>

                <h6
                    class="text-center mb-2"
                    style="color: red"
                >
                    <?= $data ?>
                </h6>

            <?php } ?>
        </div>
    </div>
</div>

<script>
    window.print()

    setTimeout(() => {
        window.close()
    }, 2000);
</script>
</body>

</html>