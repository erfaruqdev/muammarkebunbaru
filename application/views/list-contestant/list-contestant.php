<?php $this->load->view('partials/header'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-2">
                <select id="changeContest" class="form-control form-control-sm w-100" onchange="loadData()">
                    <option value="">..:Semua Lomba:..</option>
                    <?php
                    foreach ($contest as $c) {
                        if ($c->id == 1 || $c->id == 2 || $c->id == 8) {
                            $id = 1;
                        } else {
                            $id = 2;
                        }
                    ?>
                        <option data-id="<?= $id ?>" value="<?= $c->id ?>"><?= $c->name ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">
                <select id="changeCategory" class="form-control form-control-sm w-100" onchange="loadData()">
                    <option value="">..:Semua Kategori:..</option>
                    <option value="1">PUTRA</option>
                    <option value="2">PUTRI</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-2">
                <select id="changeJury" class="form-control form-control-sm w-100">
                    <option value="">..:Pilih Juri:..</option>
                    <option value="1">JURI I</option>
                    <option value="2">JURI II</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">
                <form id="form-jury" action="<?= base_url() ?>listcontestant/printjury" target="_blank" method="post">
                    <input type="hidden" name="contest" id="contest-jury" value="">
                    <input type="hidden" name="contest_id" id="contest-id" value="">
                    <input type="hidden" name="category" id="category-jury" value="">
                    <input type="hidden" name="jury" id="jury" value="">
                    <button type="button" class="btn btn-primary btn-sm w-100" id="submit-jury">
                        <i class="fas fa-user-tie"></i> Print Juri
                    </button>
                </form>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">
                <form id="form-mc" action="<?= base_url() ?>listcontestant/printmc" target="_blank" method="post">
                    <input type="hidden" name="contest" id="contest-mc" value="">
                    <input type="hidden" name="category" id="category-mc" value="">
                    <button type="button" class="btn btn-primary btn-sm w-100" id="submit-mc">
                        <i class="fas fa-user-clock"></i> Print MC
                    </button>
                </form>
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

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('list-contestant/js-list-contestant'); ?>