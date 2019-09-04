<div class="container-fluid">
    <div class="col-md-8">
        <div class="col-m">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('admin/ganti_password_admin') ?>" method="post">
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
                <hr>
                <a href="<?= base_url('admin/profile_admin') ?>" class="btn btn-warning">Keluar</a>
                <button type="submit" class="btn btn-success">Selesai</button>
            </form>
        </div>

    </div>
</div>