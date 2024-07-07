<div class="row mb-0">
    <div class="col-md-6 col-lg-3 col-xl-3">
        <div class="info-box mb-2 mb-sm-0">
            <span class="info-box-icon bg-info"><i class="fas fa-school"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Partisipasi</span>
                <span class="info-box-number">
                    <?= $school ?> <span class="font-weight-normal">dari <b>80</b> Lembaga</span>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-xl-3">
        <div class="info-box mb-2 mb-sm-0">
            <span class="info-box-icon bg-info"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Seluruh Peserta</span>
                <span class="info-box-number">
                    <?= $participants[2] ?> <span class="font-weight-normal">Orang</span>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-xl-3">
        <div class="info-box mb-2 mb-sm-0">
            <span class="info-box-icon bg-success"><i class="fa fa-male"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Peserta Putra</span>
                <span class="info-box-number">
                    <?= $participants[0] ?> <span class="font-weight-normal">Orang</span>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-xl-3">
        <div class="info-box mb-2 mb-sm-0">
            <span class="info-box-icon bg-danger"><i class="fa fa-female"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Peserta Putri</span>
                <span class="info-box-number">
                    <?= $participants[1] ?> <span class="font-weight-normal">Orang</span>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6 col-lg-4 col-xl-4">
        <div class="callout callout-info mb-2 mb-sm-0">
            <h6>Berdarkan jenis lomba (<?= $participants[2] ?>)</h6>
            <hr>
            <dl class="row mb-0">
                <?php
                if ($contests) {
                    foreach ($contests as $contest) {
                ?>
                        <dt class="col-10 font-weight-normal"><?= $contest->name ?></dt>
                        <dd class="col-2 text-center"><?= $contest->total ?></dd>
                <?php
                    }
                }
                ?>
            </dl>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-4">
        <div class="callout callout-success mb-2 mb-sm-0">
            <h6>Bagian putra (<?= $participants[0] ?>)</h6>
            <hr>
            <dl class="row mb-0">
            <?php
            if ($contestsByMale) {
                foreach ($contestsByMale as $contest) {
                    ?>
                    <dt class="col-10 font-weight-normal"><?= $contest->name ?></dt>
                    <dd class="col-2 text-center"><?= $contest->total ?></dd>
                    <?php
                }
            }
            ?>
            </dl>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-4">
        <div class="callout callout-danger mb-2 mb-sm-0">
            <h6>Bagian putri (<?= $participants[1] ?>)</h6>
            <hr>
            <dl class="row mb-0">
            <?php
            if ($contestsByFemale) {
                foreach ($contestsByFemale as $contest) {
                    ?>
                    <dt class="col-10 font-weight-normal"><?= $contest->name ?></dt>
                    <dd class="col-2 text-center"><?= $contest->total ?></dd>
                    <?php
                }
            }
            ?>
            </dl>
        </div>
    </div>
</div>
<hr>