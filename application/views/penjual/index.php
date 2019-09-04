<!--banner-->
<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Daftar Ikan</h3>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- Begin Page Content -->
<div class="container-fluid">
    <a href="<?= base_url('penjual/tambah_barang'); ?>" class="btn btn-success" style="margin-top:10px;margin-bottom:10px;">Tambah ikan</a>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <?php foreach ($barang as $b) : ?>
            <div class="col-md-4 m-wthree">
                <div class="col-m">
                    <img src="<?= base_url('assets/img/barang/') . $b['image_barang']; ?>" class="img-fluid" style="height:150px;">
                    <div class=" mid-1">
                        <div class="women">
                            <p style="font-size:16px;"><b><?= $b['nama_barang']; ?></b></p>
                            <h6><?php $stock = json_decode($b['stock_barang'], true);
                                if ($stock['satuan'] == 'kilo') {
                                    echo $stock['stok'] . ' Kg';
                                } else {
                                    echo $stock['stok'] / 10 . ' Kg';
                                }
                                ?></h6>
                        </div>
                        <div class="mid-2">
                            <p><em class="item_price">Rp. <?= number_format($b['harga_barang'], 0, ',', '.'); ?></em>/ Kg</p>
                        </div>
                        <form action="<?= base_url('penjual/delete'); ?>" method="post">
                            <a href="<?= base_url('penjual/edit_barang/') . enkrip_url($b['id']); ?>" class="btn btn-success" style="margin-bottom:5px;" data-id="<?= $b['id'] ?>">Edit</a>
                            <input type="hidden" id="id" name="id" value="<?= $b['id']; ?>">
                            <button class="btn btn-danger" style="margin-bottom:5px;">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->