<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Pembayaran</h3>
        <div class="clearfix"> </div>
    </div>
</div>

<div class="container-fluid">
    <br>
    <div class=" con-w3l">
        <div class="col-md-8">
            <?= $this->session->flashdata('message'); ?>
            <?php foreach ($pesan as $p) : ?>
                <div class="col-m" style="margin-bottom:10px;">
                    <h4><b>Invoice : <?= $p['id']; ?></b></h4>
                    <div class="women">
                        <h6>Nama Ikan : <?= getDataBarang($p['id_barang']); ?></h6>
                        <h6>Jumlah : <?= $p['jmlh_barang']; ?> <?= getSatuan($p['id_satuan']); ?></h6>
                        <h6>Catatan : <?= $p['request']; ?></h6>
                        <h6>Alamat : <?= $p['alamat']; ?></h6>
                        <h6>Total Harga : Rp. <?= number_format($p['biaya'], 0, ',', '.'); ?></h6>
                        <br>
                        <h6>Status : <b><?= getStatus($p['id_status']); ?></b></h6>
                        <br>
                    </div>
                    <a href="<?= base_url('user/kirimbukti/') . enkrip_url($p['id']); ?>" class="btn btn-success" style="margin-bottom:5px;" data-id="<?= $p['id']; ?>">
                        Konfirmasi Pembayaran
                    </a>
                    <form action="<?= base_url('user/delete'); ?>" method="post">
                        <input type="hidden" id="id" name="id" value="<?= $p['id']; ?>">
                        <button class="btn btn-danger" style="margin-bottom:5px;">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>