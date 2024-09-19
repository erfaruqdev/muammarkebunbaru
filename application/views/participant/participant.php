<?php $this->load->view('partials/header'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <div class="row">
            <div class="col-12 col-sm-4 mb-2">
                <h4 class="card-title mt-xl-1 pl-2">Data Peserta Muammar</h4>
            </div>
            <div class="col-4 col-sm-4 col-md-6 col-lg-3 col-xl-2 mb-2">
                <select id="changeCategory" onchange="loadData()" class="form-control form-control-sm w-100">
                    <option value="">..:Kategori:..</option>
                    <option value="1">PUTRA</option>
                    <option value="2">PUTRI</option>
                </select>
            </div>
            <div class="col-2 col-sm-4 col-md-6 col-lg-3 col-xl-2 mb-2">
                <form action="<?= base_url() ?>participant/printCard" method="post" target="_blank">
                    <input type="hidden" name="category" id="category-participant" value="">
                    <button type="submit" class="btn btn-sm btn-primary w-100">
                        <i class="fa fa-print"></i> <span class="d-none d-sm-inline">Print Kartu</span>
                    </button>
                </form>
            </div>
            <div class="col-2 col-sm-4 col-md-6 col-lg-3 col-xl-2 mb-2">
                <a href="<?= base_url() ?>participant/export" class="btn btn-sm btn-primary w-100" target="_blank">
                    <i class="fa fa-download"></i> <span class="d-none d-sm-inline"> Kartu</span>
                </a>
            </div>
            <div class="col-4 col-sm-4 col-md-6 col-lg-3 col-xl-2 mb-2">
                <button type="button" class="btn btn-sm btn-primary w-100 <?= ($setting > 0) ? 'd-none' : 'd-inline-block' ?>" data-toggle="modal" data-target="#modal-participant">
                    <i class="fa fa-plus-circle"></i> Tambah
                </button>
                <button type="button" class="btn btn-sm btn-danger w-100 <?= ($setting > 0) ? 'd-inline-block' : 'd-none' ?>" onclick="errorAlert('Pendaftaran peserta sudah ditutup')">
                    <i class="fas fa-exclamation-circle"></i> Registrasi Ditutup
                </button>
            </div>
        </div>
        <div class="row" id="loader">
            <div class="col-12 text-center pt-5">
                <img src="<?= base_url() ?>assets/images/loader.gif" width="100">
                <h6 class="text-primary font-italic">
                    Ke pasar beli pepaya, tunggu sebentar, ya.....
                </h6>
            </div>
        </div>
        <div class="row mt-3" id="load-data"></div>
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-participant" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Peserta</h6>
            </div>
            <div class="modal-body">
                <form id="form-participant" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <select id="category" name="category" class="form-control w-100">
                                    <option value="">..:Pilih:..</option>
                                    <option value="1">PUTRA</option>
                                    <option value="2">PUTRI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="address">Alamat Lengkap</label>
                                <textarea placeholder="Desa - Kecamatan - Kabupaten" class="form-control text-capitalize" id="address" name="address" rows="3" tabindex="1"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="contest-edit">Lomba Pidato</label>
                                <input type="text" name="name[7]" class="form-control text-uppercase" tabindex="2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name-edit">Lomba Baca Kitab</label>
                                <input type="text" name="name[3]" class="form-control text-uppercase" tabindex="3">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name-edit">Lomba Tartil Al-Qur'an</label>
                                <input type="text" name="name[4]" class="form-control text-uppercase" tabindex="4">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name-edit">Lomba Rangking Satu</label>
                                <input type="text" name="name[2]" class="form-control text-uppercase" tabindex="5">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name-edit">Lomba Merangkai Kalimat</label>
                                <input type="text" name="name[8]" class="form-control text-uppercase" tabindex="6">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name-edit">Lomba Muhafadzah</label>
                                <input type="text" name="name[5]" class="form-control text-uppercase" tabindex="7">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name-edit">Lomba Praktik Shalat</label>
                                <input type="text" name="name[6]" class="form-control mb-3 text-uppercase" tabindex="8">
                                <input type="text" name="name[11]" class="form-control mb-3 text-uppercase" tabindex="9">
                                <input type="text" name="name[12]" class="form-control text-uppercase" tabindex="10">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name-edit">Lomba Cerdas Cermat</label>
                                <input type="text" name="name[1]" class="form-control mb-3 text-uppercase" tabindex="11">
                                <input type="text" name="name[13]" class="form-control mb-3 text-uppercase" tabindex="12">
                                <input type="text" name="name[14]" class="form-control text-uppercase" tabindex="13">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name">Lomba Shalawat Nabi</label>
                                <input type="text" name="name[9]" class="form-control mb-3 text-uppercase" tabindex="14">
                                <input type="text" name="name[15]" class="form-control mb-3 text-uppercase" tabindex="15">
                                <input type="text" name="name[16]" class="form-control text-uppercase" tabindex="16">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name">Lomba Tahsin Bil Hifdzi</label>
                                <input type="text" name="name[10]" class="form-control mb-3 text-uppercase" tabindex="17">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between p-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="save()">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-participant-edit" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Edit Peserta</h6>
            </div>
            <div class="modal-body">
                <form id="form-participant-edit" autocomplete="off">
                    <input type="hidden" id="id-edit" value="0" name="id_edit">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="category-edit">Kategori</label>
                                <select id="category-edit" name="category_edit" class="form-control w-100">
                                    <option value="">..:Pilih:..</option>
                                    <option value="1">PUTRA</option>
                                    <option value="2">PUTRI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="contest-edit">Jenis Lomba</label>
                                <select id="contest-edit" name="contest_edit" class="form-control w-100">
                                    <option value="">..:Pilih:..</option>
                                    <?php
                                    foreach ($contest as $c) {
                                    ?>
                                        <option value="<?= $c->id ?>"><?= $c->name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="name-edit">Nama</label>
                                <input type="text" class="form-control text-uppercase" id="name-edit" name="name_edit">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-6">
                            <div class="form-group">
                                <label for="address-edit">Alamat Lengkap</label>
                                <textarea placeholder="Desa - Kecamatan - Kabupaten" class="form-control text-capitalize" id="address-edit" name="address_edit" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between p-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="saveEdit()">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('participant/js-participant'); ?>