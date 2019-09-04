$(document).ready(function () {

    $('.col-md-8').on('click', '.btn.btn-success', function () {
        $('#idPesananProses').val(this.dataset.id);
    });

    const base_url = '/admin/Web_ecommerce/';

    $('#jmlh_barang').on('keyup', function () {
        let jmlPesanan = this.value;
        const idBarang = $('#id_barang').val();
        let satuanBrt = $('#stn_berat :selected').val();

        $.getJSON(`../getDataStok/${idBarang}`, data => {
            let dataStok = data.stok;

            (data.satuan === 'ons') ? dataStok = dataStok / 10 : dataStok=dataStok;

            (satuanBrt === '1') ? jmlPesanan = jmlPesanan / 10 : jmlPesanan=jmlPesanan;
            
            if(parseFloat(jmlPesanan) <= parseFloat(dataStok)){
                $('#btn_byr_pesanan').prop('disabled',false);
            }else{
                $('#btn_byr_pesanan').prop('disabled',true);
            }
        });

        if (jmlPesanan !== "") {
            let harga = $('#hargaBrg').text();
            let hargaSlice = harga.slice(4);
            let hargaReplace = parseInt(hargaSlice.replace('.', ''));
            let ongkirSementara = parseInt($('#totalOngkirSementara').val());

            if (satuanBrt === '1') {
                let totalBrg = Math.ceil(hargaReplace / 10 * jmlPesanan + ongkirSementara);

                $('#totalHrgBrg').text(`Rp ${new Intl.NumberFormat('de-DE').format(totalBrg)}`);
                $('input[name="totalHrgBrgOngkir"]').val(totalBrg);

            } else {
                let totalBrg = Math.ceil(hargaReplace * jmlPesanan + ongkirSementara);

                $('#totalHrgBrg').text(`Rp ${new Intl.NumberFormat('de-DE').format(totalBrg)}`);
                $('input[name="totalHrgBrgOngkir"]').val(totalBrg);

            }
        }
    });

    $('#alamatPencarian').on('keyup', function (e) {
        e.preventDefault();
        let value = this.value;

        $.getJSON('https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/place/textsearch/json?query=' + value + '&key=AIzaSyBuS2NaAZ3LanbU7bxgGMCHdw1OnszWMak', function (data) {

            if (data.status === 'OK') {
                $('.area-list-pencarian').html('');
                let isi = data.results;

                $('.area-hasil-pencarian').addClass('active');
                $.each(isi, (i, value) => {
                    $('.area-list-pencarian').append(`
                    <div class="list-pencarian" data-place="${value['place_id']}">${value['formatted_address']}</div>
                    `);
                });
            } else if (data.status === 'ZERO_RESULTS') {
                $('.area-hasil-pencarian').addClass('active');
                $('.area-list-pencarian').html(`
                    <div class="list-pencarian">Alamat harus lengkap</div>
                    `);
            }
        });
    });

    $('.area-list-pencarian').on('click', '.list-pencarian', function () {
        let dataPlace = this.dataset.place;
        let dataOrigin = `${$('#dataLatLong').attr('data-lat')},${$('#dataLatLong').attr('data-long')}`;

        $('.area-hasil-pencarian').removeClass('active');
        $('#alamatPencarian').val($(this).text());

        $.getJSON(`https://cors-anywhere.herokuapp.com/https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=${dataOrigin}&destinations=place_id:${dataPlace}&key=AIzaSyBuS2NaAZ3LanbU7bxgGMCHdw1OnszWMak`, data => {
            let dataJarak = data.rows[0]['elements'][0]['distance']['value'];
            let hitungOngkir = dataJarak / 1000 * 3000;
            let clearHrg = $('#totalHrgBrg').text().slice(4).replace('.', '');

            $('#totalOngkirSementara').val(hitungOngkir);
            $('#totalHrgBrg').text('Rp. ' + new Intl.NumberFormat('de-DE').format(parseInt(clearHrg) + hitungOngkir));
            $('input[name="totalHrgBrgOngkir"]').val(parseInt(clearHrg) + hitungOngkir);

        });
    });

    $('#filterSearch').on('change', function () {
        let val = this.value;
        let dataKeyword = $('#keywordFilter').val();

        if (val === '1') {
            $.getJSON(`./getFilter?keyword=${dataKeyword}&filter=harga_barang`, data => {
                $('#viewSearch').html(data);
            });
        } else if (val === '2') {
            $.getJSON(`./getFilter?keyword=${dataKeyword}&filter=stock_barang`, data => {
                $('#viewSearch').html(data);
            });
        } else if (val === '3') {

            $.ajax({
                method: 'POST',
                url: 'https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyBuS2NaAZ3LanbU7bxgGMCHdw1OnszWMak',
                dataType: 'json',
                success: function (data) {
                    $.getJSON(`./getFilter?keyword=${dataKeyword}&filter=terdekat&lati=${data.location['lat']}&longti=${data.location['lng']}`, data => {
                        $('#viewSearch').html(data);
                    });
                }
            });

            // navigator.geolocation.getCurrentPosition(data => {
            //     let lat = data.coords.latitude;
            //     let long = data.coords.longitude;

            //     // console.log(data);
            //     $.getJSON(`./getFilter?keyword=${dataKeyword}&filter=terdekat&lati=${lat}&longti=${long}`, data => {
            //         $('#viewSearch').html(data);
            //     });

            // });
        }
    })

    let date = Math.floor(Date.now() / 1000);
    console.log(date);

    $('.timer').each((el) => {
        let timer = $('.timer')[el];
        let sisaWaktu = parseInt($(timer).val());
        let jam = 0;

        if (sisaWaktu > 0) {
            let menit = (sisaWaktu / 60).toString();
            let dataArray = menit.split('.');

            if (dataArray.length > 1) {
                let menit = dataArray[0];
                let detik = Math.floor((0 + "." + dataArray[1]) * 60);

                if (menit > 60) {
                    menit = menit - 60;
                    jam = '01';
                } else if (menit < 10 && menit > -1) {
                    menit = `0${menit}`;
                }

                function changeclock() {
                    if (detik == '0' && menit == '0') {
                        clearInterval();
                    } else {
                        detik = parseInt(detik);
                        detik--;

                        if (detik < 10 && detik > -1) {
                            detik = `0${detik}`;
                        }

                        if (detik < 0) {
                            detik = 59;

                            menit = parseInt(menit);
                            menit--;

                            if (menit < 10 && menit > -1) {
                                menit = `0${menit}`;
                            }

                            if (menit < 0) {
                                menit = 59

                                jam = parseInt(jam);
                                jam--;
                            }
                        }

                        if (jam > 0) {
                            $('.timeMundur').text(`${jam}: ${menit} : ${detik}`);
                        } else {
                            $('.timeMundur').text(`${menit} : ${detik}`);
                        }

                    }
                }

            }
        }

        setInterval(changeclock, 1000);
    });
});