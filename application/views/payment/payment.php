<?php $this->load->view('partials/header'); ?>
<form action="<?= base_url() ?>payment/print" method="post" target="_blank" id="form-print">
    <input type="hidden" name="invoice" id="invoice" value="0">
</form>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 mb-2">
                <h6 class="card-title mt-1">Pembayaran</h6>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 mb-2">
                <input type="text" id="changeName" class="form-control form-control-sm w-100" autofocus onkeyup="loadData()">
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mb-2">
                <select id="changeMethod" onchange="loadData()" class="form-control form-control-sm w-100">
                    <option value="">..:Metode:..</option>
                    <option value="OFFLINE">TUNAI</option>
                    <option value="ONLINE">TRANSFER</option>
                </select>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mb-2">
                <a href="<?= base_url() ?>payment/unpaid" target="_blank" class="btn mr-2 btn-sm btn-success btn-block">
                    <i class="fa fa-download"></i>
                    Download Rekap
                </a>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mb-3">
                <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#modal-payment">
                    <i class="fa fa-plus-circle"></i> Tambah <small>(Tekan F2)</small>
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
        <div class="row" id="load-data"></div>
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-payment" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Pembayaran</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <select id="method" onchange="changeMethod(this)" class="form-control w-100">
                            <option value="">..:Metode:..</option>
                            <option value="OFFLINE">TUNAI</option>
                            <option value="ONLINE">TRANSFER</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                        <div class="p-2 d-flex text-warning">
                            <span class="mr-1">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <small class="pt-1">Terlebih dahulu, pilih metode pembayaran</small>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group row mb-0">
                            <label for="id" class="col-sm-4 col-form-label">ID MMU</label>
                            <div class="col-sm-8">
                                <input autocomplete="off" data-inputmask="'mask' : '9999999999'" data-mask="" type="text" class="form-control" id="id" name="id" autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8 col-xl-8 pt-2">
                        <div class="p-2 d-flex text-success">
                            <span class="mr-1">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <small class="pt-1">Pastikan cursor fokus pada bidang inputan, lalu masukkan ID MMU santri lalu tekan ENTER</small>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group row">
                            <input type="hidden" id="id-result" value="0">
                            <label for="nominal" class="col-sm-4 col-form-label">Nominal</label>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control" id="nominal" name="nominal">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                        <h6 id="name-result"></h6>
                        <h6 id="nominal-result" class="text-bold text-success"></h6>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end p-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('payment/js-payment'); ?>