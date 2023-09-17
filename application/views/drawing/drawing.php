<?php $this->load->view('partials/header'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <div class="row" id="show-school">
            <div class="col-12">
                <div class="card" style="height: 71.8vh; overflow-y: auto;">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
                        <table class="table table-head-fixed table-hover">
                            <thead>
                            <tr>
                                <th>NO</th>
                                <th>UNDI</th>
                                <th class="text-center">NAMA</th>
                                <th>ALAMAT</th>
                                <th>PJGB</th>
                                <th>GB</th>
                                <th>UNDIAN</th>
                            </tr>
                            </thead>
                            <tbody>
                                <form id="form-save" autocomplete="off">
                                    <?php
                                    if ($schools) {
                                        $no = 1;
                                        $tab = 1;
                                        foreach ($schools as $data) {
                                            if ($this->session->userdata('role') == 'SUPER-ADMIN') {
                                                $id = $this->sm->getUsername($data->id);
                                            } else {
                                                $id = $data->id;
                                            }
                                            ?>
                                            <tr>
                                                <td class="align-middle"><?= $no++ ?></td>
                                                <td class="align-middle"><?= $data->undian ?></td>
                                                <td class="align-middle">
                                                    <b> <?= $data->name ?></b>
                                                    <br>
                                                    <span style="cursor: pointer" title="Salin ID ke clipboard" onclick="copyToClipboard('<?= $id ?>')">
                                                <small class="text-success"><?= $id ?></small>
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
                                                    <input type="number" name="drawing[<?= $data->id ?>]" value="<?= $data->undian ?>" class="form-control form-control-sm move-next" tabindex="<?= $tab++ ?>">
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr class="text-center"><td colspan="8"><h6 class="text-danger">Tak ada data untuk ditampilkan</h6></td></tr>';
                                    }
                                    ?>
                                </form>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-2">
                                <button onclick="save()" type="button" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('drawing/js-drawing'); ?>