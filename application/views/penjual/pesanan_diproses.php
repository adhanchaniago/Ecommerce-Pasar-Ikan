<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Pesanan Diproses</h3>
        <div class="clearfix"> </div>
    </div>
</div>

<!--Isi -->
<div class="container-fluid">
    <br>
    <?= $this->session->flashdata('message'); ?>
    <div class=" con-w3l">
        <div class="col-md-8">
            <?php foreach ($pesanan as $p) : ?>
                <div class="col-m" style="margin-bottom:10px;">
                    <div class="card-title" style="padding:5px;">
                        <input type="hidden" class="timer" value="<?= ($p['pesanan_dibuat'] + 7200) - time() ?>">
                        <h5 class="timeMundur">Time : </h5>
                    </div>
                    <div class="card-body" style="padding:5px;margin-bottom:5px;">
                        <h5><b>INVOICE : <?= $p['id']; ?></b></h5>
                        <h6>Nama Ikan : <?= getDataBarang($p['id_barang']); ?></h6>
                        <h6>Jumlah : <?= $p['jmlh_barang']; ?> <?= getSatuan($p['id_satuan']); ?></h6>
                        <h6>Request : <?= $p['request']; ?></h6>
                        <h6>Nama Pembeli : <?= getDataPembeli($p['id_pembeli']); ?></h6>
                        <h6>Alamat Kirim : <?= $p['alamat']; ?></h6>
                        <h6>Total Harga : Rp. <?= number_format($p['biaya'], 0, ',', '.'); ?></h6>
                        <br>
                        <h6>Nomor Resi : <?= $p['resi']; ?></h6>
                    </div>
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#inputresimodal" class="offer-img" data-id="<?= $p['id']; ?>">Input Resi</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class=" modal fade" id="inputresimodal" tabindex="-1" role="dialog" aria-labelledby="inputresimodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputresimodalLabel">Input Nomor Resi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="idPesananProses" name="id" value="">
                        <label for="name">Nomor Resi</label>
                        <input type="text" class="form-control" id="nomor_resi" name="nomor_resi" value="">
                        <?= form_error('nomor_resi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>