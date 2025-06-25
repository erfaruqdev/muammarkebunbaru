<?php $this->load->view('partials/header'); ?>
<?php
$username = $this->session->userdata('username');
?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content p-4">
        <div class="row mb-5">
            <div class="col-12 col-sm-6 mb-3 mb-sm-0">
                <h5>Profil</h5>
                <h6 class="text-muted">Nama dan Username</h6>
                <p class="mb-2">
                    Cara ubah username
                </p>
                - Minimal enam karakter <br>
                - Harus huruf alfabet kecil tanpa spasi <br>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form autocomplete="off" method="post" id="form-update-profile">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user->name ?: ''  ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $user->username ?: ''  ?>">
                            </div>
                            <div class="form-group mb-0">
                                <label for="password">Password</label>
                                <input type="password" class="form-control password" id="password" name="password">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-outline-primary btn-block" onclick="updateProfile()">Simpan Pembaruan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 mb-3 mb-sm-0"">
                <h5>Password</h5>
                <p class="mb-2">
                    - Sangat dianjurkan untuk update password secara berkala <br>
                    - Password minimal enam karakter
                </p>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form autocomplete="off" method="post" id="form-update-password">
                            <div class="form-group">
                                <label for="current_password">Password Saat Ini</label>
                                <input type="password" class="form-control password" id="current_password" name="current_password">
                            </div>
                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <input type="password" class="form-control password" id="new_password" name="new_password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Ulangi Password Baru</label>
                                <input type="password" class="form-control password" id="password_confirmation" name="password_confirmation">
                            </div>
                            <div class="d-flex justify-content-end" id="showPassword" style="cursor: pointer">
                                <small>
                                    <span>Tampilkan Password</span> <i class="fa fa-eye"></i>
                                </small>
                            </div>
                            <div class="d-none justify-content-end" id="hidePassword" style="cursor: pointer">
                                <small>
                                    <span>Sembunyikan Password</span> <i class="fa fa-eye-slash"></i>
                                </small>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-outline-primary btn-block" onclick="updatePassword()">Perbarui Password</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('partials/footer'); ?>
<?php $this->load->view('profile/js-profile'); ?>