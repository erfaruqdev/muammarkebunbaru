<?php $this->load->view('partials/header'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <div class="row">
            <div class="col-lg-7 col-xl-7"></div>
            <div class="col-6 col-lg-3 col-xl-3 mb-2">
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
            <div class="col-6 col-lg-2 col-xl-2">
                <select id="changeCategory" class="form-control form-control-sm w-100" onchange="loadData()">
                    <option value="">..:Semua Kategori:..</option>
                    <option value="1">PUTRA</option>
                    <option value="2">PUTRI</option>
                </select>
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
        <div class="row mt-2" id="load-data"></div>
    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('perfome/js-perfome'); ?>