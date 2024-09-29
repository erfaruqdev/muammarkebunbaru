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
                <td>CC</td>
                <td>RS</td>
                <td>BK</td>
                <td>TQ</td>
                <td>MUH</td>
                <td>PS</td>
                <td>PID</td>
                <td>MK</td>
                <td>SN</td>
                <td>TH</td>
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
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 1) ?></td>
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 2) ?></td>
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 3) ?></td>
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 4) ?></td>
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 5) ?></td>
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 6) ?></td>
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 7) ?></td>
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 8) ?></td>
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 9) ?></td>
                    <td><?= $this->cm->pointByContestAjax($d->school_id, 10) ?></td>
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