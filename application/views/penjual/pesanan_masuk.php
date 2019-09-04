<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Pesanan Masuk</h3>
        <div class="clearfix"> </div>
    </div>
</div>

<!--Isi -->
<div class="container-fluid1">
    <br>
    <div class=" con-w3l">
        <div class="col-md-8">
            <?php foreach ($pesanan as $p) : ?>
                <div class="col-m" style="margin-bottom:5px;">
                    <div class="women">
                        <input type="hidden" class="timer" value="<?= ($p['pesanan_dibuat'] + 7200) - time() ?>">
                        <h5 class="timeMundur">Time : </h5>
                        <h5><b>INVOICE : <?= $p['id']; ?></b></h5>
                        <h6>Nama Ikan : <?= getDataBarang($p['id_barang']); ?></h6>
                        <h6>Jumlah : <?= $p['jmlh_barang']; ?> <?= getSatuan($p['id_satuan']); ?></h6>
                        <h6>Request : <?= $p['request']; ?></h6>
                        <h6>Nama Pembeli : <?= getDataPembeli($p['id_pembeli']); ?></h6>
                        <h6>Alamat Kirim : <?= $p['alamat']; ?></h6>
                        <h6>Total Harga : Rp. <?= number_format($p['biaya'], 0, ',', '.'); ?></h6>
                    </div>
                    <br>
                    <form action="<?= base_url('penjual/diproses'); ?>" method="post">
                        <input type="hidden" id="id" name="id" value="<?= $p['id']; ?>">
                        <button type="submit" class="btn btn-warning" style="margin-bottom:5px;">Proses Pesanan</button>
                    </form>
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tolakmodal" class="offer-img" data-id="<?= $p['id']; ?>">Tolak Pesanan</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- Modal -->
<div class=" modal fade" id="tolakmodal" tabindex="-1" role="dialog" aria-labelledby="tolakmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tolakmodalLabel">Alasan Penolakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('penjual/ditolak'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="idPesananProses" name="id" value="">
                        <select type="text" class="form-control" id="status" name="status">
                            <option value="">--Pilih Alasan Penolakan--</option>
                            <option value="7">Stock Habis</option>
                            <option value="7">Toko Sudah Tutup</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>