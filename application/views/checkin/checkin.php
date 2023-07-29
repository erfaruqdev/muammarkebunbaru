<?php $this->load->view('partials/header'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <?php if (date('Y-m-d H:i:s') < '2022-10-23 06:30:00') { ?>
            <div class="row mt-3">
                <div class="error-page" style="margin-top: 100px;">
                    <div class="error-content">
                        <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! ada masalah nih....</h3>
                        <p>
                            Check in peserta belum dibuka ~<br>
                            <br>
                            <a href="<?= base_url() ?>">Klik untuk kembali ke Beranda</a>
                        </p>
                    </div>
                </div>
            </div>

        <?php } else { ?>
            <div class="row">
                <section class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-2">
                                <label for="mmu-id" class="col-sm-4 col-form-label">NO. REG</label>
                                <div class="col-sm-8">
                                    <input data-inputmask="'mask' : '9999999999'" data-mask="" type="text" class="form-control" id="mmu-id" name="mmu_id" autofocus>
                                </div>
                            </div>
                            <div class="p-2 d-flex text-success">
                                <span class="mr-1">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <small class="pt-1">Pastikan cursor fokus pada bidang inputan. <br> Tekan F2 untuk fokus.</small>
                            </div>
                        </div>
                    </div>
                    <div id="show-data"></div>
                </section>
                <section class="col-lg-8" id="show-result"></section>
            </div>
        <?php } ?>
    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('checkin/js-checkin'); ?>