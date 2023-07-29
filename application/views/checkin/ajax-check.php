<div class="row">
    <?php
    if ($status == 400) {
    ?>
        <div class="col-12">
            <div id="alert-no" class="alert alert-danger" role="alert">
                <?= $data ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h6>INFORMASI LEMBAGA</h6>
                    <hr>
                    <span class="text-success">Nama MMU</span> <br>
                    <b><?= $data->name ?></b> <br>
                    <span><?= $data->village . ', ' . $data->city ?></span>
                    <table class="table mt-3">
                        <tbody>
                            <tr>
                                <td>
                                    <span class="text-success">Nama PJGB</span>
                                </td>
                                <td>
                                    <span class="text-success">Nama GB</span> <br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b><?= $data->pjgb ?></b>
                                </td>
                                <td>
                                    <b><?= $data->gb ?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <b class="text-success">Status</b> <br>
                    <span><?= setTimeDiff($data->created_at) ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $data->amount ?></h3>
                    <p>Orang</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Jumlah Peserta
                </a>
            </div>
            <button type="button" class="btn btn-danger btn-block" onclick="deleteRegistration(<?= $data->registration ?>)">
                <i class="fas fa-trash"></i> Batalkan
            </button>
        </div>
</div>
<?php
    }
?>