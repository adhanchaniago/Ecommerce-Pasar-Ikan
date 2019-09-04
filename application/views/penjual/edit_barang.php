<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Edit Barang</h3>
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
                    <input type="hidden" id="id" name="id" value="<?= $barang['id']; ?>">
                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input class="form-control-file" type="file" name="image" value="">
                        <input type="hidden" name="image" value="<?= $barang['image_barang']; ?>" />
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_ikan">Nama Ikan</label>
                        <input type="text" class="form-control" id="name_ikan" name="name_ikan" value="<?= $barang['nama_barang']; ?>">
                        <?= form_error('name_ikan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="stok_ikan">Stock Ikan</label>
                        <input type="text" class="form-control" id="stok_ikan" name="stok_ikan" value="<?= $barang['stock_barang']; ?>">
                        <?= form_error('stok_ikan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="harga_ikan">Harga Ikan</label>
                        <input type="text" class="form-control" id="harga_ikan" name="harga_ikan" value="<?= $barang['harga_barang']; ?>">
                        <?= form_error('harga_ikan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <a href="<?= base_url('penjual'); ?>" class="btn btn-warning">Keluar</a>
                    <button type="submit" class="btn btn-success">Selesai</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <br>
</div>