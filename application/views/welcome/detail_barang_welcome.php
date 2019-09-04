<div class="container-fluid" style="margin-top:40px;">
    <br>
    <div class="card">
        <?= $this->session->flashdata('message'); ?>
        <img src="<?= base_url('assets/img/barang/') . $barang['image_barang']; ?>" class="img-responsive" style="width:95%;" alt="">
        <div class="card-body-1">
            <h6 class="card-text-2"><?= getDataPenjual($barang['id_penjual']); ?></h6>
            <h3 class="card-title-barang" style=""><?= $barang['nama_barang']; ?></h3>
            <h6 class="card-text-3"><?php $stock = json_decode($barang['stock_barang'], true);
                                    if ($stock['satuan'] == 'kilo') {
                                        echo $stock['stok'] . ' Kg';
                                    } else {
                                        echo $stock['stok'] / 10 . ' Kg';
                                    }
                                    ?></h6> <br>
            <h5 class="card-text-3">Rp.<?= number_format($barang['harga_barang'], 0, ',', '.'); ?></h5>
        </div>
        <a href="<?= base_url('auth'); ?>" class="btn btn-success" style="width:25%;margin:auto;margin-bottom:5px;">Beli</a>
    </div>
</div>