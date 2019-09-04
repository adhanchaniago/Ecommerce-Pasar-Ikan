<div class="content-top" style="margin-top:55px;">
    <div class="select" style="margin: 0 5px 10px 5px;">
        <select class="form-control form-control-sm" name="urutkan" id="filterSearch">
            <option value="0">-- Urutkan --</option>
            <option value="1">Murah - Mahal</option>
            <option value="2">Terbanyak - sedikit</option>
            <option value="3">Terdekat</option>
        </select>
    </div>

    <div class="container">
        <div class="row" style="margin:auto;" id="viewSearch">
            <?php foreach ($cari as $b) : ?>
                <div class="col-sm m-wthree">
                    <div class="col-m">
                        <img src="<?= base_url('assets/img/barang/') . $b['image_barang'] ?>" class="img-fluid" alt="" style="width:150px;height:150px;">
                        <div class="mid-1">
                            <div class="women">
                                <p style="font-size:16px;"><b><?= $b['nama_barang'] ?></b></p>
                                <h6>Stock : <?php $stock = json_decode($b['stock_barang'], true);
                                            if ($stock['satuan'] == 'kilo') {
                                                echo $stock['stok'] . ' Kg';
                                            } else {
                                                echo $stock['stok'] / 10 . ' Kg';
                                            }
                                            ?></h6>
                            </div>
                            <div class="mid-2">
                                <p><em class="item_price">Rp. <?= number_format($b['harga_barang'], 0, ',', '.'); ?></em> / Kg</p>
                                <div class="clearfix"></div>
                            </div>
                            <a href="<?= base_url('user/detail_barang/') . enkrip_url($b['id']); ?>" class="btn btn-warning">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <br>
            <br>
        </div>
    </div>
</div>