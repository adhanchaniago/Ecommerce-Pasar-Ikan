<div class="container">
    <?= $this->session->flashdata('message'); ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" id="id" name="id" value="<?= $pesanan['id']; ?>">
            <label for="id_pembeli">ID Pembeli</label>
            <input type="number" class="form-control" id="id_pembeli" name="id_pembeli" value="<?= $pesanan['id_pembeli']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="id_penjual">ID Penjual</label>
            <input type="number" class="form-control" id="id_penjual" name="id_penjual" value="<?= $pesanan['id_penjual']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="id_barang">ID Barang</label>
            <input type="number" class="form-control" id="id_barang" name="id_barang" value="<?= $pesanan['id_barang']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="jmlh_barang">Jumlah Barang</label>
            <input type="number" class="form-control" id="jmlh_barang" name="jmlh_barang" value="<?= $pesanan['jmlh_barang']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="id_satuan">Satuan</label>
            <input type="text" class="form-control" id="id_satuan" name="id_satuan" value="<?= $pesanan['id_satuan']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="request">Catatan</label>
            <input type="text" class="form-control" id="request" name="request" value="<?= ($pesanan['request']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= ($pesanan['alamat']); ?>" readonly>
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="email" name="email" value="<?= (getEmail($pesanan['id_penjual'])); ?>">
        </div>
        <div class="form-group">
            <label for="biaya">Biaya</label>
            <input type="text" class="form-control" id="biaya" name="biaya" value="<?= ($pesanan['biaya']); ?>">
        </div>
        <div class="form-group">
            <label for="resi">Resi</label>
            <input type="text" class="form-control" id="resi" name="resi" value="<?= ($pesanan['resi']); ?>" readonly>
        </div>
        <a href="<?= base_url('admin/pesanan_masuk'); ?>" class="btn btn-secondary">Keluar</a>
        <button type="submit" class="btn btn-success">kirim</button>
    </form>
</div>