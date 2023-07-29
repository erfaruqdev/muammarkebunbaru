<?php $this->load->view('partials/header'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-3">
        <div class="row">
            <?php
                if ($payment > 0) {
            ?>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <img src="<?= base_url() ?>assets/images/qrcodes/<?= @$data->id.'.png' ?>" alt="Foto Barcode" width="100%">
                            </div>
                            <hr>
                            <div class="mb-0">
                                <h6 class="text-center text-success">ID : <?= @$data->id ?></h6>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>MMU</th>
                                            <th><?= @$data->name ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><?= @$data->village.', '.@$data->city ?></td>
                                        </tr>
                                        <tr>
                                            <td>PJGB</td>
                                            <td><?= @$data->pjgb ?></td>
                                        </tr>
                                        <tr>
                                            <td>GB</td>
                                            <td><?= @$data->gb ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <a href="<?= base_url() ?>registration/invoice" target="_blank" class="btn btn-primary btn-block">
                                <i class="fas fa-download"></i> Download Invoice
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="callout callout-success">
                        <h6>Catatan</h6>
                        <p>Pada saat pelaksanaan MUAMMAR, Anda punya dua opsi check in:</p>
                        <ul>
                            <li>Tunjukkan QR Code</li>
                            <li>Anda bisa unduh bukti pembayaran dan kartu check in, print out dan tunjukkan hasil print out-nya</li>
                        </ul>
                    </div>
                </div>
            <?php
                } else {
            ?>
                <div class="col-lg-6">
                    <div id="alert-yes" class="alert alert-danger" role="alert">
                        <p class="mb-4"><b>Kartu Registrasi </b> tidak bisa diterbitkan karena belum melunasi biaya pendaftaran</p>
                        Segera lakukan pembayaran!
                    </div>
                </div>
            <?php } ?>
        </div>

    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('registration/js-registration'); ?>