<?php $this->load->view('partials/header'); ?>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content p-3">
            <div class="row">
                <section class="col-lg-4 connectedSortable ui-sortable">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $resultCalendar = $this->session->flashdata('import-calendar');
                            if ($resultCalendar) {
                                $classCalendar = [1 => 'success', 'danger', 'danger'];
                                $textCalendar = [
                                    1 => 'Yeaaahh..! Data santri berhasil diimport',
                                    'Oppsss..! Format kolom dalam file tidak valid',
                                    'Oppsss..! Ekstensi file harus .xls atau .xlxs'
                                ];
                                ?>
                                <div class="alert alert-<?= $classCalendar[$resultCalendar] ?> alert-dismissible fade show" role="alert">
                                    <?= $textCalendar[$resultCalendar] ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                            }
                            ?>
                            <form id="form-import-student" action="<?= base_url() ?>setting/importcalendar" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <label for="file">Import Data Kalender</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="hidden" id="file-selected" value="">
                                            <input type="file" class="custom-file-input" name="file" id="file">
                                            <label class="custom-file-label" id="label-file" for="file">Pilih file</label>
                                        </div>
                                        <ul class="text-success mt-3">
                                            <li>Pastikan file ber-ekstensi .xls atau xlsx</li>
                                            <li>Pastikan format sesuai sample</li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex justify-content-end mt-4">
                                <button id="import-file" class="btn btn-sm btn-primary btn-sm" type="submit">
                                    <i class="fas fa-file-import"></i> Import
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable ui-sortable">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $resultSchool = $this->session->flashdata('import-school');
                            if ($resultSchool) {
                                $classSchool = [1 => 'success', 'danger', 'danger'];
                                $textSchool = [
                                    1 => 'Yeaaahh..! Data santri berhasil diimport',
                                    'Oppsss..! Format kolom dalam file tidak valid',
                                    'Oppsss..! Ekstensi file harus .xls atau .xlxs'
                                ];
                                ?>
                                <div class="alert alert-<?= $classSchool[$resultSchool] ?> alert-dismissible fade show" role="alert">
                                    <?= $textSchool[$resultSchool] ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                            }
                            ?>
                            <form id="form-import-school" action="<?= base_url() ?>setting/importschool" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <label for="file">Import Data MMU</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="hidden" id="file-selected-school" value="">
                                            <input type="file" class="custom-file-input" name="file" id="file-school">
                                            <label class="custom-file-label" id="label-file-school" for="file">Pilih file</label>
                                        </div>
                                        <ul class="text-success mt-3">
                                            <li>Pastikan file ber-ekstensi .xls atau xlsx</li>
                                            <li>Pastikan Nomor NIS tidak duplikat baik dalam file-nya atau dalam database</li>
                                            <li>Pastikan format sesuai sample</li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex justify-content-end mt-4">
                                <button id="import-file-school" class="btn btn-sm btn-primary btn-sm" type="submit">
                                    <i class="fas fa-file-import"></i> Import
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <!-- /.content -->
    </div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('setting/js-setting'); ?>