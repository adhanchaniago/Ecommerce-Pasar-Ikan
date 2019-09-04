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
                <form action="<?= base_url('penjual/edit_profile_penjual') ?>" method="post">
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
                        <label for="nama_pasar">Nama Pasar</label>
                        <select type="text" class="form-control" id="id_pasar" name="id_pasar">
                            <option value="">--Pilih Lokasi Pasar--</option>
                            <?php foreach ($nama as $n) : ?>
                                <?php if ($edit['id'] == $n['id']) : ?>
                                    <option value="<?= $n['id']; ?>" selected><?= $n['nama_pasar']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $n['id']; ?>"><?= $n['nama_pasar']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('nama_pasar', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telpon</label>
                        <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= $users['no_telp']; ?>">
                        <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="no_lapak">No Lapak</label>
                        <input type="text" class="form-control" id="no_lapak" name="no_lapak" value="<?= $users['no_lapak'] ?>">
                        <?= form_error('no_lapak', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <a href="<?= base_url('penjual/edit_profile'); ?>" class="btn btn-secondary">Keluar</a>
                    <button type="submit" class="btn btn-success">Selesai</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <br>
</div>