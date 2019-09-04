<div class="banner-top" style="margin-top:45px;">
    <div class="container">
        <h3>Input Checkout</h3>
        <div class="clearfix"> </div>
    </div>
</div>

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="card" style="margin:5px 5px 5px 5px;padding:10px;">
            <form action="" method="post">
                <input type="hidden" id="dataLatLong" data-lat="<?= getDataLatLong($barang['id_penjual'])['latitude']; ?>" data-long="<?= getDataLatLong($barang['id_penjual'])['longtitude']; ?>">
                <input type="hidden" id="id_barang" value="<?= $this->uri->segment(3) ?>">
                <img src="<?= base_url('assets/img/barang/') . $barang['image_barang']; ?>" class="img-fluid" style="height:30vh;">
                <div class="form-group">
                    <h4><b><?= $barang['nama_barang']; ?></b></h4>
                    <h5 id="hargaBrg">Rp. <?= number_format($barang['harga_barang'], 0, ',', '.'); ?></h5>
                </div>
                <div class="form-group area-hasil-pencarian">
                    <label for="exampleInputEmail1">Masukan Alamat</label>
                    <input type="text" class="form-control" id="alamatPencarian" name="alamatkirim">
                    <div class="area-list-pencarian">
                    </div>
                </div>
                <div class="form-group">
                    <div id="map" style="height: 100%" class="w-100"></div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="Jumlah">Jumlah</label>
                    </div>
                    <div class="col-4 pr-1">
                        <input type="number" class="form-control" id="jmlh_barang" name="jmlh_barang" value="">
                        <?= form_error('jmlh_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-4 pl-0">
                        <select type="text" class="custom-select mr-sm-2" id="stn_berat" name="stn_berat">
                            <option value="1" selected>Ons</option>
                            <option value="2">Kg</option>
                        </select>
                        <?= form_error('stn_berat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row" style="margin-top:5px;">
                    <label for="request" class="col-sm-2 col-form-label">Catatan Untuk Toko</label>
                    <div class="col-md">
                        <textarea class="form-control" id="request" name="request" rows="3" cols="1000"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" id="totalOngkirSementara" value="0">
                    <div class="row">
                        <div class="col-7">
                            <label for="biaya">Total Harga + Ongkir</label>
                        </div>
                        <div class="col-5">
                            <input type="hidden" name="totalHrgBrgOngkir">
                            <h6 id="totalHrgBrg">Rp. <?= number_format($barang['harga_barang'], 0, ',', '.') ?></h6>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" id="btn_byr_pesanan">Bayar</button>
                <a href="<?= base_url('user'); ?>" class="btn btn-danger">
                    Batalkan
                </a>
            </form>
        </div>
    </div>
    <br>
    <br>
</div>