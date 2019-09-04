<div class="banner-top" style="margin-top:20px;">
    <div class="container">
        <h3>Edit Profile</h3>
    </div>
</div>

<div class="container-fluid">
    <br>
    <div class=" con-w3l">
        <div class="col-md-8">
            <div class="col-m">
                <form action="<?= base_url('user/edit_profile_pembeli'); ?>" method="post">
                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input class="form-control-file" type="file" name="image" placeholder="" value="" />
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $users['name']; ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $users['email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= $users['address']; ?>">
                        <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telpon</label>
                        <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= $users['no_telp']; ?>">
                        <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <a href="<?= base_url('user/edit_profile'); ?>" class="btn btn-warning">Keluar</a>
                    <button type="submit" class="btn btn-success">Tambahkan</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <br>
</div>