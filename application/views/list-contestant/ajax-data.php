<div class="col-12">
    <div class="card" style="height: 71.8vh;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
            <table class="table table-head-fixed table-hover">
                <thead>
                    <tr>
                        <th>UNDI</th>
                        <th>PESERTA</th>
                        <th>MMU</th>
                        <th>LOMBA</th>
                        <th>KATEGORI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data) {
                        $categories = [1 => 'PUTRA', 'PUTRI'];
                        foreach ($data as $d) {
                    ?>
                            <tr>
                                <td class="align-middle"><?= $d->undian ?></td>
                                <td class="align-middle">
                                    <?= $d->name ?>
                                </td>
                                <td class="align-middle">
                                    <?= $d->mmu ?>
                                </td>
                                <td class="align-middle">
                                    <?= $d->contest ?>
                                </td>
                                <td class="align-middle">
                                    <?= $categories[$d->category] ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr class="text-center"><td colspan="7"><h6 class="text-danger">Tak ada data untuk ditampilkan</h6></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer justify-content-between">
            Total : <b><?= $amount ?></b> Orang
        </div>
    </div>
</div>