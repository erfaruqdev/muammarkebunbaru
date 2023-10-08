<?php $this->load->view('partials/header'); ?>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content p-3">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-2">
                    <select class="form-control form-control-sm w-100" onchange="setContest(this)">
                        <option value="">..:Semua Lomba:..</option>
                        <?php
                        foreach ($contests as $c) {
                            if ($c->id == 1 || $c->id == 2 || $c->id == 8) {
                                $id = 1;
                            } else {
                                $id = 2;
                            }
                            ?>
                            <option <?= ($contest == $c->id) ? 'selected' : '' ?> value="<?= $c->id ?>"><?= $c->name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">
                    <select class="form-control form-control-sm w-100" onchange="setCategory(this)">
                        <option value="">..:Semua Kategori:..</option>
                        <option <?= ($category == '1') ? 'selected' : '' ?> value="1">PUTRA</option>
                        <option <?= ($category == '2') ? 'selected' : '' ?> value="2">PUTRI</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
                    <form action="<?= base_url() ?>valuation/create" method="post">
                        <input type="hidden" name="contest" id="contest" value="<?= @$contest ?>">
                        <input type="hidden" name="category" id="category" value="<?= @$category ?>">
                        <button type="submit" class="btn btn-primary btn-sm w-100" id="submit-jury">
                            <i class="fas fa-plus-circle"></i> Cek Data
                        </button>
                    </form>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-2">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">
                    <a href="<?= base_url() ?>valuation" class="btn btn-default btn-sm btn-block">
                        <i class="fas fa-list"></i> Daftar Nilai
                    </a>
                </div>
            </div>
            <?php if ($contest && $category) { ?>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-head-fixed table-hover">
                                <thead>
                                <tr>
                                    <th>UNDI</th>
                                    <th>PESERTA</th>
                                    <th>MMU</th>
                                    <th>NILAI</th>
                                    <th>POIN</th>
                                    <th>RANK</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form action="<?= base_url() ?>valuation/update" autocomplete="off" id="form-add" method="post">
                                    <input type="hidden" name="contest" value="<?= $contest ?>">
                                    <input type="hidden" name="category" value="<?= $category ?>">
                                <?php
                                if ($contest) {
                                    if ($contest == 1 || $contest == 6 || $contest == 9) {
                                        $dkk = ', DKK';
                                    }else{
                                        $dkk = '';
                                    }
                                }
                                $no = 1;
                                if ($participants) {
                                    foreach ($participants as $participant) {
                                ?>
                                    <tr>
                                        <td class="align-middle"><?= $participant['undian'] ?></td>
                                        <td class="align-middle"><?= $participant['name'].$dkk ?></td>
                                        <td class="align-middle"><?= $participant['mmu'] ?></td>
                                        <td class="align-middle">
                                            <input name="nilai[<?= $participant['mmu'] ?>]" type="number" class="form-control form-control-sm num" value="<?= $participant['nilai'] ?>">
                                        </td>
                                        <td class="align-middle">
                                            <input disabled name="point[<?= $participant['mmu'] ?>]" type="number" class="form-control form-control-sm point" value="<?= $participant['point'] ?>">
                                        </td>
                                        <td class="align-middle"><?= $participant['rank'] ?></td>
                                    </tr>
                                <?php
                                    }
                                }
                                ?>
                                </form>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                                    <button class="btn btn-primary btn-block" onclick="add()">
                                        <i class="fas fa-sync-alt"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { ?>
                <div class="row mt-5">
                    <div class="error-page">
                        <div class="error-content">
                            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Ada masalah nih</h3>
                            <p>
                                Pastikan jenis lomba dan kategori sudah dipilih. <br>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
        <!-- /.content -->
    </div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('valuation/create/js-valuation-edit'); ?>