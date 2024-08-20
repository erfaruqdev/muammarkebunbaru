<div class="col-12">
    <div class="card" style="height: 71.8vh; overflow-y: auto;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
            <table class="table table-head-fixed table-hover">
                <thead>
                    <tr>
                        <th>UNDI</th>
                        <th class="text-center">NAMA</th>
                        <th>ALAMAT</th>
                        <th>PJGB</th>
                        <th>GB</th>
                        <th>NO. HP</th>
                        <th>OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($datas) {
                        foreach ($datas as $data) {
                            if ($this->session->userdata('role') == 'SUPER-ADMIN') {
                                $id = $this->sm->getUsername($data->id);
                            } else {
                                $id = $data->id;
                            }
                    ?>
                            <tr>
                                <td class="align-middle"><?= $data->undian ?></td>
                                <td class="align-middle">
                                    <b> <?= $data->name ?></b>
                                    <br>
                                    <span style="cursor: pointer" title="Salin ID ke clipboard" onclick="copyToClipboard('<?= $id ?>')">
                                        <small class="text-success"><?= $id ?></small>
                                        <i class="fas fa-copy ml-1 text-success"></i>
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <?= $data->address . ', ' . $data->village . '<br>' . $data->district . ', ' . $data->city ?>
                                </td>
                                <td class="align-middle">
                                    <?= $data->pjgb ?>
                                </td>
                                <td class="align-middle">
                                    <?= $data->gb ?>
                                </td>
                                <td class="align-middle text-xs">
                                    <?= $data->phone ?>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-default" title="Atur ulang password" onclick="resetPassword('<?= $data->id ?>')">
                                        <i class="fas fa-user-lock"></i>
                                    </button>
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
            <b>Total MMU : <?= $amount ?> lembaga<b>
        </div>
    </div>
</div>