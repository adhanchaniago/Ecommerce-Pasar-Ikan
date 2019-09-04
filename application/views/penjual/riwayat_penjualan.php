<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Riwayat Penjualan</h3>
        <div class="clearfix"> </div>
    </div>
</div>

<!--Isi -->
<div class="container-fluid1" style="margin-bottom:60px;">
    <br>
    <?= $this->session->flashdata('message'); ?>
    <div class=" con-w3l">
        <div class="col-md-8">
            <form action="<?= base_url('penjual/total_pencairan') ?>" method="post">
                <?php foreach ($pesanan as $p) : ?>
                    <div class="col-m" style="margin-bottom:10px;">
                        <div class="card-body" style="padding:5px;margin-bottom:5px;">
                            <h5><b>Status : <?= getStatus($p['id_status']); ?></b></h5>
                            <h5><b>INVOICE : <?= $p['id']; ?></b></h5>
                            <h6>Nama Ikan : <?= getDataBarang($p['id_barang']); ?></h6>
                            <h6>Jumlah : <?= $p['jmlh_barang']; ?> <?= getSatuan($p['id_satuan']); ?></h6>
                            <h6>Request : <?= $p['request']; ?></h6>
                            <h6>Nama Pembeli : <?= getDataPembeli($p['id_pembeli']); ?></h6><br>
                            <input type="checkbox" name="ceklist[]" value="<?= $p['id']; ?>">
                            <label for="check">Pilih untuk dicairkan</label>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col text-center mt-2 mb-5">
                    <button type="submit" class="btn btn-success">Cairkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Main Content -->