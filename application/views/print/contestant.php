<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekapitulasi Peserta Muammar</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: 'Segoe UI', 'Corbel', Courier, monospace;
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 12pt;
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

        .mb-1 {
            margin-bottom: 1rem;
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
            border: 1px solid #999797;
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
        
        .border {
            background-color: #181616;
            height: 1px;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .rotate {
            -moz-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
            -webkit-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
            transform:  translateX(-50%) translateY(-50%) rotate(-90deg);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-7">
                <img class="logo" src="<?= base_url() ?>assets/images/header-print-color.png" alt="">
            </div>
        </div>
        <div class="border"></div>
        <div class="row">
            <div class="col-12">
                <?php
                if ($mmu) {
                ?>
                    <h6 class="text-center mb-1">
                        REKAPITULASI PESERTA MUAMMAR <?= ($category == 1) ? 'PUTRA' : 'PUTRI' ?>
                    </h6>
                    <table class="table-xl tablestripped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>MMU</th>
                                <th>PJGB</th>
                                <th>GB</th>
                                <?php
                                if ($contest) {
                                    foreach ($contest as $c) {
                                        ?>
                                        <th><?= $c->name ?></th>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($mmu as $d) {
                                $contest1 = $this->cm->checkContestPerMmu($d->id, 1, $category);
                                $contest2 = $this->cm->checkContestPerMmu($d->id, 2, $category);
                                $contest3 = $this->cm->checkContestPerMmu($d->id, 3, $category);
                                $contest4 = $this->cm->checkContestPerMmu($d->id, 4, $category);
                                $contest5 = $this->cm->checkContestPerMmu($d->id, 5, $category);
                                $contest6 = $this->cm->checkContestPerMmu($d->id, 6, $category);
                                $contest7 = $this->cm->checkContestPerMmu($d->id, 7, $category);
                                $contest8 = $this->cm->checkContestPerMmu($d->id, 8, $category);
                                $contest9 = $this->cm->checkContestPerMmu($d->id, 9, $category);
                                $contest10 = $this->cm->checkContestPerMmu($d->id, 10, $category);
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $d->name ?></td>
                                    <td><?= $d->pjgb ?></td>
                                    <td><?= $d->gb ?></td>
                                    <td class="text-center"><?= $contest1 ?></td>
                                    <td class="text-center"><?= $contest2 ?></td>
                                    <td class="text-center"><?= $contest3 ?></td>
                                    <td class="text-center"><?= $contest4 ?></td>
                                    <td class="text-center"><?= $contest5 ?></td>
                                    <td class="text-center"><?= $contest6 ?></td>
                                    <td class="text-center"><?= $contest7 ?></td>
                                    <td class="text-center"><?= $contest8 ?></td>
                                    <td class="text-center"><?= $contest9 ?></td>
                                    <td class="text-center"><?= $contest10 ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                ?>
                    <h6 class="text-center mb-2" style="color: red">
                        Tidak ada untuk ditampilkan
                    </h6>
                <?php
                }
                ?>
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