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
                <form target="_blank" action="<?= base_url() ?>valuation/printResult" id="form-print" method="post">
                    <input type="hidden" name="contest" id="contest" value="">
                    <input type="hidden" name="category" id="category" value="">
                    <button type="button" class="btn btn-default btn-sm w-100" onclick="submitPrint()">
                        <i class="fas fa-print"></i> Print Per Lomba
                    </button>
                </form>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">

            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2 mb-2">
                <a href="<?= base_url() ?>valuation/create" class="btn btn-primary btn-sm btn-block">
                    <i class="fas fa-plus-circle"></i> Input Nilai
                </a>
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
<?php $this->load->view('valuation/js-valuation'); ?>