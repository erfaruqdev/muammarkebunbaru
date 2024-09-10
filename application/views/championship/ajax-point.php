<?php
if ($status == 200) {
?>
    <table class="table table-sm mb-0">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle">NO</th>
                <th rowspan="2" style="vertical-align: middle">MMU</th>
                <th rowspan="2" style="vertical-align: middle">PJGB</th>
                <th rowspan="2" style="vertical-align: middle">GB</th>
                <th colspan="10" style="vertical-align: middle; text-align: center">LOMBA</th>
                <th rowspan="2" style="vertical-align: middle" class="text-center">POIN</th>
            </tr>
            <tr>
                <?php
                $contests = $this->cm->contest();
                if ($contests) {
                    foreach ($contests as $contest) {
                        ?>
                        <td class="rotate"><?= $contest->name ?></td>
                            <?php
                    }
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $d) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <span class="text-success"><?= $d->name ?></span> <br>
                        <small><?= $d->village . ', ' . $d->city ?></small>
                    </td>
                    <td><?= $d->pjgb ?></td>
                    <td><?= $d->gb ?></td>
                    <td class="text-center"><?= $d->points ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
?>
    <div class="error-page">
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Ada masalah nih</h3>
            <p>
                <?= $data ?>. <br>
            </p>
        </div>
    </div>
<?php
}
?>