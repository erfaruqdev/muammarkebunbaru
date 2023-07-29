<?php $this->load->view('partials/header'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-2">
                <input type="text" id="changeName" class="form-control form-control-sm w-100" placeholder="Tekan F2 lalu masukkan nama" autofocus onkeyup="loadData()">
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 col-xl-2 mb-2">
                <select id="changeZone" onchange="loadData()" class="form-control form-control-sm w-100" style="width: 150px">
                    <option value="">..:Semua:..</option>
                    <option value="Sumenep">Sumenep</option>
                    <option value="Pamekasan">Pamekasan</option>
                    <option value="Sampang">Sampang</option>
                    <option value="Bangkalan">Bangkalan</option>
                    <option value="Luar Madura">Luar Madura</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-2">
                <a href="<?= base_url() ?>school/analytic" target="_blank" class="btn mr-2 btn-sm btn-success btn-block">
                    <i class="fa fa-download"></i>
                    Download Kesimpulan
                </a>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2 mb-2">
                <form action="<?= base_url() ?>school/print" method="post" target="_blank">
                    <input type="hidden" name="zone" id="zone" value="">
                    <button type="submit" class="btn mr-2 btn-sm btn-primary btn-block">
                        <i class="fa fa-print"></i>
                        Print Out
                    </button>
                </form>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-2">
                <a href="<?= base_url() ?>school/export" target="_blank" class="btn mr-2 btn-sm btn-success btn-block">
                    <i class="fa fa-download"></i>
                    Export Excel
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
        <div class="row" id="show-school"></div>
    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('school/js-school'); ?>