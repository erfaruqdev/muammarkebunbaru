<?php $this->load->view('partials/header'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-2">
                <h4 class="card-title mt-xl-1 pl-2">Data Peserta Muammar</h4>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-2">
                <select id="changeMMU" class="form-control w-100 select2bs4">
                    <option value="">..:Semua MMU:..</option>
                    <?php
                    if ($mmu) {
                        foreach ($mmu as $m) {
                    ?>
                            <option value="<?= $m->id ?>"><?= $m->name . ' - ' . $m->village . ', ' . $m->city ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">
                <select id="changeCategory" class="form-control w-100">
                    <option value="">..:Kategori:..</option>
                    <option value="1">PUTRA</option>
                    <option value="2">PUTRI</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">
                <select id="changeContest" class="form-control w-100" onchange="loadData()">
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
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">
                <button type="button" class="btn btn-primary w-100 <?= ($setting > 0) ? 'd-none' : 'd-inline-block' ?>" data-toggle="modal" data-target="#modal-contestant">
                    <i class="fa fa-plus-circle"></i> Tambah Peserta
                </button>
                <button type="button" class="btn btn-danger w-100 <?= ($setting > 0) ? 'd-inline-block' : 'd-none' ?>" onclick="errorAlert('Pendaftaran peserta sudah ditutup')">
                    <i class="fa fa-plus-circle"></i> Registrasi Ditutup
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

<div class="modal fade" id="modal-contestant" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Peserta</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">
                            Pastikan MMU dan Kategori sudah dipilih
                        </div>
                    </div>
                </div>
                <form id="form-contestant" autocomplete="off">
                    <input type="hidden" name="mmu" id="mmu" value="">
                    <input type="hidden" name="category" id="category" value="">
                    <div class="form-group row">
                        <label for="address" class="col-sm-4 col-form-label">Alamat Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" placeholder="Desa - Kecamatan - Kabupaten" id="address" name="address" class="form-control text-capitalize" tabindex="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name1" class="col-sm-5 col-form-label">CERDAS CERMAT</label>
                        <div class="col-sm-7">
                            <input type="text" name="name[1]" class="form-control mb-3 text-uppercase" tabindex="2">
                            <input type="text" name="name[9]" class="form-control mb-3 text-uppercase" tabindex="3">
                            <input type="text" name="name[10]" class="form-control text-uppercase" tabindex="4">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">PIDATO</label>
                        <div class="col-sm-7">
                            <input type="text" name="name[7]" class="form-control text-uppercase" tabindex="5">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">BACA KITAB</label>
                        <div class="col-sm-7">
                            <input type="text" name="name[3]" class="form-control text-uppercase" tabindex="6">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">TARTIL AL-QUR'AN</label>
                        <div class="col-sm-7">
                            <input type="text" name="name[4]" class="form-control text-uppercase" tabindex="7">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">RANGKING SATU</label>
                        <div class="col-sm-7">
                            <input type="text" name="name[2]" class="form-control text-uppercase" tabindex="8">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">MERANGKAI KALIMAT</label>
                        <div class="col-sm-7">
                            <input type="text" name="name[8]" class="form-control text-uppercase" tabindex="9">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">MUHAFADZAH</label>
                        <div class="col-sm-7">
                            <input type="text" name="name[5]" class="form-control text-uppercase" tabindex="10">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">PRAKTIK SHALAT</label>
                        <div class="col-sm-7">
                            <input type="text" name="name[6]" class="form-control mb-3 text-uppercase" tabindex="11">
                            <input type="text" name="name[11]" class="form-control mb-3 text-uppercase" tabindex="12">
                            <input type="text" name="name[12]" class="form-control text-uppercase" tabindex="13">
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

<div class="modal fade" id="modal-edit-contestant" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Peserta</h6>
            </div>
            <div class="modal-body">
                <form id="form-edit-contestant" autocomplete="off">
                    <input type="hidden" id="id-edit" value="0" name="id_edit">
                    <input type="hidden" id="mmu-edit" value="0" name="mmu_edit">
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
<?php $this->load->view('contestant/js-contestant'); ?>