<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Cairkan</h3>
        <div class="clearfix"> </div>
    </div>
</div>

<!--Isi -->
<div class="container-fluid">
    <br>
    <?= $this->session->flashdata('message'); ?>
    <div class=" con-w3l">
        <div class="col-md-8">
            <form action="<?= base_url('user/total_pencairan') ?>" method="post">
                <?php foreach ($cair as $c) : ?>
                    <div class="col-m" style="margin-bottom:10px;">
                        <div class="card-body" style="padding:5px;margin-bottom:5px;">
                            <h5><b>Status : <?= getStatus($c['id_status']); ?></b></h5>
                            <h5><b>INVOICE : <?= $c['id']; ?></b></h5>
                            <h6>Nama Ikan : <?= getDataBarang($c['id_barang']); ?></h6>
                            <h6>Jumlah : <?= $c['jmlh_barang']; ?> <?= getSatuan($c['id_satuan']); ?></h6>
                            <h6>Request : <?= $c['request']; ?></h6>
                            <h6>Harga : <?= $c['biaya']; ?></h6><br>
                            <input type="checkbox" name="ceklist[]" value="<?= $c['id']; ?>">
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