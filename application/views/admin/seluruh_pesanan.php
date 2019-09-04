<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <div class="table">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th style="font-size:12px;">Invoice</th>
                    <th style="font-size:12px;">Nama Pembeli</th>
                    <th style="font-size:12px;">Nama Penjual</th>
                    <th style="font-size:12px;">Nama Barang</th>
                    <th style="font-size:12px;">Jumlah Barang</th>
                    <th style="font-size:12px;">Satuan Berat</th>
                    <th style="font-size:12px;">Catatan Pembeli</th>
                    <th style="font-size:12px;">Alamat Pengiriman</th>
                    <th style="font-size:12px;">Total Biaya</th>
                    <th style="font-size:12px;">Bukti Transfer</th>
                    <th style="font-size:12px;">Resi</th>
                    <th style="font-size:12px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan as $p) : ?>
                    <tr>
                        <th style="font-size:12px;"><?= $p['id']; ?></th>
                        <td style="font-size:12px;"><?= $p['id_pembeli']; ?></td>
                        <td style="font-size:12px;"><?= getPenjual($p['id_penjual']); ?></td>
                        <td style="font-size:12px;"><?= getDataBarang($p['id_barang']); ?></td>
                        <td style="font-size:12px;"><?= $p['jmlh_barang']; ?></td>
                        <td style="font-size:12px;"><?= getSatuan($p['id_satuan']); ?></td>
                        <td style="font-size:12px;"><?= $p['request']; ?></td>
                        <td style="font-size:12px;"><?= $p['alamat']; ?></td>
                        <td style="font-size:12px;"><?= $p['biaya']; ?></td>
                        <td style="font-size:12px;"><img src="<?= base_url('assets/img/barang/') . $p['image']; ?>" class="img-fluid" style="width:150px;height:150px;" alt=""></td>
                        <td style="font-size:12px;"><?= $p['resi']; ?></td>
                        <td style="font-size:12px;"><?= getDataStatus($p['id_status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="col"><?= $pagination ?></div>
    </div>
</div>