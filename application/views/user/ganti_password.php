<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Edit Profile</h3>
        <div class="clearfix"> </div>
        <div class="row">
            <div class="col-lg-6">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <br>
    <div class=" con-w3l">
        <div class="col-md-8">
            <div class="col-m">
                <?= $this->session->flashdata('message'); ?>
                <form action="<?= base_url('user/changePassword'); ?>" method="post">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control" id="password_lama" name="password_lama">
                        <?= form_error('password_lama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="new_password1">Password Baru</label>
                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                        <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="new_password2">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                        <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <a href="<?= base_url('user/edit_profile'); ?>" type="button" class="btn btn-secondary">Keluar</a>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <br>
</div>