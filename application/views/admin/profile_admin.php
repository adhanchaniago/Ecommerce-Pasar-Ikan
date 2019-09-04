<div class="container">
    <?php if ($this->session->flashdata('message')) : ?>
        <?= $this->session->flashdata('message'); ?>
    <?php endif ?>
    <div class="card" style="width:500px;">
        <img class="img-fluid" src="<?= base_url('assets/img/foto/') . $users['image']; ?>" style="max-width:200px;max-height:200px;">
        <div class="card-body">
            <h5 class="card-title"><?= $users['name']; ?></h5>
            <h5 class="card-title"><?= $users['address']; ?></h5>
            <h5 class="card-title"><?= $users['no_telp']; ?></h5>
            <a href="<?= base_url('admin/edit_profile_admin'); ?>" class="btn btn-primary">Edit Profile</a>
            <a href="<?= base_url('admin/ganti_password_admin'); ?>" class="btn btn-primary">Ganti Password</a>
        </div>
    </div>
</div>