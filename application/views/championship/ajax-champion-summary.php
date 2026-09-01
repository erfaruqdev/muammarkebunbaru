<?php
if ($status == 200) {
    ?>
    <table class="table table-sm table-hover mb-0">
        <thead>
        <tr>
            <th style="width: 50px">NO</th>
            <th>MADRASAH</th>
            <th>PJGB</th>
            <th>GB</th>
            <th class="text-center">JUARA LOMBA</th>
            <th class="text-center">JUMLAH POINT</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if ($data) {
            $no = 1;

            foreach ($data as $d) {
                ?>
                <tr>
                    <td class="align-middle">
                        <?= $no++ ?>
                    </td>

                    <td class="align-middle">
                            <span class="text-success">
                                <?= $d->madrasah ?>
                            </span>
                    </td>

                    <td class="align-middle">
                        <?= $d->pjgb ?>
                    </td>

                    <td class="align-middle">
                        <?= $d->gb ?>
                    </td>

                    <td class="align-middle text-center">
                        <?= $d->jumlah_contest_dijuarai ?>
                    </td>

                    <td class="align-middle text-center">
                        <strong>
                            <?= $d->jumlah_point ?>
                        </strong>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" class="text-center">
                    <h6 class="text-danger">
                        Tak ada data untuk ditampilkan
                    </h6>
                </td>
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
            <h3>
                <i class="fas fa-exclamation-triangle text-danger"></i>
                Oops! Ada masalah nih
            </h3>

            <p>
                <?= $data ?>
            </p>
        </div>
    </div>
    <?php
}
?>