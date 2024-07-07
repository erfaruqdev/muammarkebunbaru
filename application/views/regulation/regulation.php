<?php $this->load->view('partials/header'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <div class="row justify-content-center mb-3">
            <div class="col-12 col-lg-4 col-md-4 col-xl-4">
                <a href="<?= base_url() ?>regulation/download" target="_blank" class="btn btn-success btn-block">
                    <i class="fas fa-download"></i> Download PDF
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <img src="<?= base_url() ?>assets/images/regulations/1.jpg" width="100" alt="Foto" class="product-image" loading="lazy">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <img src="<?= base_url() ?>assets/images/regulations/2.jpg" width="100" alt="Foto" class="product-image" loading="lazy">
                </div>
            </div>
        </div>
        <?php
        for ($i = 3; $i <= 12; $i++){
        ?>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card" style="background-color: #0f401b">
                        <img data-src="<?= base_url() ?>assets/images/regulations/<?= $i ?>.jpg" alt="Foto sedang diambil" loading="lazy" class="product-image lazy">
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('registration/js-registration'); ?>