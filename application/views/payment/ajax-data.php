<div class="col-12">
    <div class="card" style="height: 71.8vh;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
            <table class="table table-head-fixed table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th class="text-center">NAMA</th>
                        <th>PEMBAYARAN</th>
                        <th>PJGB/GB</th>
                        <th>METODE</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($datas) {
                        $no = 1;
                        foreach ($datas as $data) {

                    ?>
                            <tr>
                                <td class="align-middle"><?= $no++ ?></td>
                                <td class="align-middle">
                                    <b> <?= $data->name ?></b>
                                    <br>
                                    <small class="text-success">
                                        <?= $data->village . ', ' . $data->city ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <small> <?= $data->invoice ?> </small> <br>
                                    Rp. <?= number_format($data->amount, 0, ',', '.') ?>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        <?= $data->pjgb ?> <br>
                                        <?= $data->gb ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <?= ($data->method == 'OFFLINE') ? 'TUNAI' : 'TRANSFER' ?> <br>
                                    <small class="badge badge-<?= ($data->status == 'LUNAS') ? 'success' : 'danger' ?>"><?= strtolower($data->status) ?></small>
                                </td>
                                <td class="align-middle">
                                    <form target="_blank" action="<?= base_url() ?>payment/print" method="post">
                                        <input type="hidden" name="invoice" value="<?= $data->invoice ?>">
                                        <button type="submit" class="btn btn-default btn-sm" title="Print Kuitansi">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr class="text-center"><td colspan="8"><h6 class="text-danger">Tak ada data untuk ditampilkan</h6></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer justify-content-between">
            Total Pemasukan : <b>Rp. <?= number_format($total->total, 0, ',', '.') ?></b>
        </div>
    </div>
</div>