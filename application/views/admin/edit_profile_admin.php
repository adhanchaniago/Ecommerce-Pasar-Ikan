<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $users['email']; ?>">
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $users['name']; ?>">
            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea class="form-control" name="address" id="" cols="30" rows="10">
            <?= $users['address']; ?>
            </textarea>
            <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="no_telp">Nomor Telpon</label>
            <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= $users['no_telp']; ?>">
            <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <a href="<?= base_url('admin/profile_admin'); ?>" class="btn btn-secondary">Keluar</a>
        <button type="submit" class="btn btn-success">kirim</button>
    </form>
</div>