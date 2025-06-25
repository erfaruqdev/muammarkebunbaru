<div class="row">
    <div class="col-12 col-md-12 col-sm-12 col-lg-9 pt-3 pl-5">
        <dl class="row">
            <dt class="col-sm-2 font-weight-normal">Nama</dt>
            <dd class="col-sm-10 font-weight-bold"><?= $this->session->userdata('name') ?></dd>
            <dt class="col-sm-2 font-weight-normal">Username</dt>
            <dd class="col-sm-10">
                <?= $username ?>
            </dd>
            <dt class="col-sm-2 font-weight-normal">
                <small class="text-danger mt-2 ml-3 d-none" id="errorusername">
                    <i class="fas fa-exclamation"></i>
                    <span id="is-error" class="ml-1"></span>
                </small>
            </dt>
            <dd class="col-sm-10">
                <div class="row mt-2 pl-2 d-none" id="wrap-change-username">
                    <input type="hidden" id="current_username" value="<?= $username ?>">
                    <div class="col-12 mb-2">
                        <input type="text" class="form-control form-control-sm" name="username" id="username" autocomplete="off">
                    </div>
                    <div class="col-12 mb-2">
                        <button onclick="saveUsername('<?= $username ?>')" class="btn btn-default btn-xs px-3">Simpan</button>
                        <button onclick="cancelChangeUsername()" class="btn btn-danger btn-xs px-3 ml-2">Batal</button>
                    </div>
                </div>
            </dd>
            <dt class="col-sm-2 font-weight-normal">Hak Akses</dt>
            <dd class="col-sm-10 text-primary">
                        <span class="badge badge-success">
                            <?= $this->session->userdata('text_role') ?>
                        </span>
            </dd>
        </dl>
        <hr>
        <button class="btn btn-default btn-xs px-3" onclick="changeUsername()">
            <i class="fas fa-user-edit"></i> Ubah Username
        </button>
        <button class="btn btn-default btn-xs px-3" onclick="showChangePasword()">
            <i class="fas fa-key"></i> Ubah Kata Sandi
        </button>
        <div id="wrap-change-password" class="d-none">
            <hr>
            <div class="row">
                <div class="col-5">
                    <form autocomplete="off" id="formchangepassword">
                        <input type="hidden" name="current_username" value="<?= $username ?>">
                        <div class="form-group">
                            <label for="password" class="font-weight-normal">Kata Sandi Baru</label>
                            <input type="password" class="form-control form-control-border" name="password" id="password">
                            <small class="text-danger errors" id="errorpassword"></small>
                            <small id="text-strength"></small>

                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="font-weight-normal">Ulangi Kata Sandi Baru</label>
                            <input type="password" class="form-control form-control-border" name="password_confirmation" id="password_confirmation">
                            <small class="text-danger errors" id="errorpassword_confirmation"></small>
                        </div>
                        <div class="form-group">
                            <label for="current_password" class="font-weight-normal">Kata Sandi Saat Ini</label>
                            <input type="password" class="form-control form-control-border" name="current_password" id="current_password">
                            <small class="text-danger errors" id="errorcurrent_password"></small>
                        </div>
                    </form>
                    <button class="btn btn-default btn-sm px-3" onclick="saveNewPassword()" id="buttonsavenewpassword">
                        Simpan Kata Sandi Baru
                    </button>
                    <button class="btn btn-danger btn-sm px-3 ml-2" onclick="cancelChangePasword()">
                        Batal
                    </button>
                </div>
                <div class="col-7 pl-4">
                    <small class="text-success">
                        <b>Cara buat password kuat :</b>
                        <ul>
                            <li>Minimal 8 karakter</li>
                            <li>Gabungan angka, huruf, dan karakter khusus</li>
                            <li>Gabungan huruf kapital dan huruf kecil</li>
                        </ul>
                    </small>
                    <div class="mb-2 d-flex justify-content-start" id="showTogglePassword" style="cursor: pointer">
                        <small>
                            <span>Tampilkan Password</span> <i class="fa fa-eye"></i>
                        </small>
                    </div>
                    <div class="mb-2 d-none justify-content-start" id="hideTogglePassword" style="cursor: pointer">
                        <small>
                            <span>Sembunyikan Password</span> <i class="fa fa-eye-slash"></i>
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>