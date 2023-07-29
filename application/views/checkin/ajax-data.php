<div class="callout callout-success">
    <span>Informasi Check In</span> <i class="fas fa-check text-success"></i> <br>
    <hr>
    <div class="row">
        <div class="col-6">
            <i class="fas fa-school text-success"></i>
            <h6><?= $data->school ?> Lembaga</h6>
        </div>
        <div class="col-6">
            <i class="fas fa-users text-success"></i>
            <h6><?= ($data->contestant) ? $data->contestant : 0 ?> Orang</h6>
        </div>
    </div>
</div>