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
                        <th class="text-center">NILAI</th>
                        <th class="text-center">POINT</th>
                        <th class="text-center">RANK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($valuation) {
                        $no = 1;
                        foreach ($valuation as $d) {
                    ?>
                            <tr>
                                <td class="align-middle"><?= $d->undian ?></td>
                                <td class="align-middle">
                                    <?= $d->name ?>
                                </td>
                                <td class="align-middle">
                                    <?= $d->mmu ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $d->nilai ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $d->point ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $d->rank ?>
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
        <div class="card-footer justify-content-between"></div>
    </div>
</div>