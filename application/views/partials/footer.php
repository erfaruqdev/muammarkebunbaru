<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <?php
    $currentYear = date('Y');

    ?>
    <strong>Copyright &copy; <?= (date('Y') != $currentYear) ? $currentYear . '-' : '' ?><?= $currentYear ?> </strong><span class="text-default"> - Sekretaris III Kebun Baru</span>
</footer>

</div>
<!-- jQuery -->
<script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url() ?>template/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="<?= base_url() ?>template/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url() ?>template/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>template/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->