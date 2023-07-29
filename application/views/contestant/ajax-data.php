<div class="col-12">
    <div class="card" style="height: 71.8vh;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
            <table class="table table-head-fixed table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>ALAMAT</th>
                        <th>LOMBA</th>
                        <th>KATEGORI</th>
                        <th class="text-center">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //print_r($datas);
                    if ($data[0]) {
                        $no = 1;
                        $categories = [1 => 'PUTRA', 'PUTRI'];
                        foreach ($data[0] as $d) {
                    ?>
                            <tr>
                                <td class="align-middle"><?= $no++ ?></td>
                                <td class="align-middle">
                                    <?= $d->name ?>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        <span class="text-success">
                                            <?= $d->mmu ?> <br>
                                        </span>
                                        <?= $d->address ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <?= $d->contest_name ?>
                                </td>
                                <td class="align-middle">
                                    <?= $categories[$d->category] ?>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group">
                                        <button type="button" onclick="getData(<?= $d->id ?>)" class="btn btn-xs btn-default">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button onclick="deleteParticipant(<?= $d->id ?>)" type="button" class="btn btn-xs btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr class="text-center"><td colspan="6"><h6 class="text-danger">Tak ada data untuk ditampilkan</h6></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <b>Total Peserta : <?= $data[1] ?> orang<b> | 
            <b>Total Pendaftar : <?= $data[2] ?> lembaga<b>
        </div>
    </div>
</div>