<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Belanjaan</h3>
        <div class="clearfix"> </div>
    </div>
</div>

<div class="container-fluid">
    <br>
    <div class=" con-w3l">
        <div class="col-md-8" style="margin-bottom:50px;">
            <?= $this->session->flashdata('message'); ?>
            <?php foreach ($pesan as $p) : ?>
                <div class="col-m" style="margin-bottom:10px;">
                    <h4><b>Invoice : <?= $p['id']; ?></b></h4>
                    <div class="women">
                        <h6><b>Nama Ikan : </b><?= getDataBarang($p['id_barang']); ?></h6>
                        <h6><b>Jumlah : </b><?= $p['jmlh_barang']; ?> <?= getSatuan($p['id_satuan']); ?></h6>
                        <h6><b>Request : </b><?= $p['request']; ?></h6>
                        <h6><b>Alamat : </b><?= $p['alamat']; ?></h6>
                        <h6><b>Total Harga : </b>Rp. <?= number_format($p['biaya'], 0, ',', '.'); ?></h6>
                        <br>
                        <h6><b>Status :</b> <?= getStatus($p['id_status']); ?></h6>
                        <h6><b>Nomor Resi : </b><?= $p['resi']; ?></h6>
                        <br>
                        <?php if ($p['id_pencairan'] == 0) : ?>
                            <?php if ($p['id_status'] == 7) : ?>
                                <a href="<?= base_url('user/cairkan'); ?>" class="btn btn-success" style="margin-bottom:5px;">Cairkan</a>
                            <?php endif ?>
                        <?php endif; ?>
                    </div>
                    <form action="<?= base_url('user/diterima'); ?>" method="post">
                        <input type="hidden" id="id" name="id" value="<?= $p['id']; ?>">
                        <?php if ($p['id_status'] == 5) { ?>
                            <button type="submit" class="btn btn-success" style="margin-bottom:5px;">Konfirmasi Diterima</button>
                        <?php } ?>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>