<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Tambah Barang</h3>
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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input class="form-control-file" type="file" name="image" placeholder="" value="" />
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_ikan">Nama Ikan</label>
                        <input type="text" class="form-control" id="name_ikan" name="name_ikan" value="<?= set_value('name_ikan'); ?>">
                        <?= form_error('name_ikan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="stok_ikan">Stock Ikan</label>
                        <input type="text" class="form-control" id="stok_ikan" name="stok_ikan" value="<?= set_value('stok_ikan'); ?>">
                        <?= form_error('stok_ikan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select type="text" class="form-control" id="satuan" name="satuan">
                            <option value="kilo">KG</option>
                            <option value="ons">ONS</option>
                        </select>
                        <?= form_error('satuan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="harga_ikan">Harga Ikan</label>
                        <input type="text" class="form-control" id="harga_ikan" name="harga_ikan" value="<?= set_value('harga_ikan'); ?>">
                        <?= form_error('harga_ikan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <a href="<?= base_url('penjual'); ?>" class="btn btn-warning">Keluar</a>
                    <button type="submit" class="btn btn-success">Tambahkan</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <br>
</div>