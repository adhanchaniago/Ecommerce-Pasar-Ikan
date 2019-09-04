<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Kirim Bukti</h3>
        <div class="clearfix"> </div>
    </div>
</div>

<div class="container-fluid">
    <br>
    <div class=" con-w3l">
        <div class="col-md-8" style="margin-bottom:340px;">
            <div class="col-m">
                <?= $this->session->flashdata('message'); ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id" value="<?= $pesan['id']; ?>">
                        <input type="hidden" id="id_pembeli" name="id_pembeli" value="<?= $pesan['id_pembeli']; ?>">
                        <input type="hidden" id="id_penjual" name="id_penjual" value="<?= $pesan['id_penjual']; ?>">
                        <input type="hidden" id="id_barang" name="id_barang" value="<?= $pesan['id_barang']; ?>">
                        <input type="hidden" id="jmlh_barang" name="jmlh_barang" value="<?= $pesan['jmlh_barang']; ?>">
                        <input type="hidden" id="id_satuan" name="id_satuan" value="<?= $pesan['id_satuan']; ?>">
                        <input type="hidden" id="request" name="request" value="<?= $pesan['request']; ?>">
                        <input type="hidden" id="alamat" name="alamat" value="<?= $pesan['alamat']; ?>">
                        <input type="hidden" id="biaya" name="biaya" value="<?= $pesan['biaya']; ?>">
                        <input type="hidden" id="status" name="status" value="4">
                    </div>
                    <div class="form-group">
                        <h5 for="image">Bukti Transfer</h5>
                        <input class="form-control-file" type="file" name="image" placeholder="" value="" />
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <a href="<?= base_url('user/bayar'); ?>" class="btn btn-warning">Keluar</a>
                    <button type="submit" class="btn btn-success">Tambahkan</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <br>
</div>