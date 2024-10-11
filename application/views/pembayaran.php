<script 
type="text/javascript async"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="SB-Mid-client-JmAg7ERrpAkQFVu3">
</script>
<style>
    /* Gaya opsional untuk tombol */
    button[disabled] {
      background-color: #ccc; /* Warna tombol dinonaktifkan */
      cursor: not-allowed; /* Kursor pointer tidak diizinkan */
    }
  </style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="btn btn-sm btn-success">
                <?php 
                $grand_total = 0;
                if($keranjang = $this->cart->contents())
                {
                    foreach ($keranjang as $item)
                    {
                        $grand_total = $grand_total + $item['subtotal'];
                    }

                echo "<h4>Total Belanja Anda: Rp. ".number_format($grand_total, 0,',','.');
                 ?>
            </div><br><br>

            <h3>Input Alamat Pengiriman dan Pembayaran</h3>

            <form method="post" action="<?php echo base_url() ?>dashboard/proses_pesanan">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" id="nama"placeholder="Nama Lengkap Anda" class="form-control">
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <input type="text" name="alamat" id="alamat" placeholder="Alamat Lengkap Anda" class="form-control">
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="no_telp" id="telepon" placeholder="Nomor Telepon Anda" class="form-control">
                </div>

                <div class="form-group">
                    <label>Metode Pengiriman</label>
                    <select id="metode" class="form-control">
                        <option>JNE</option>
                        <option>J&T</option>
                        <option>TIKI</option>
                        <option>Lalamove</option>
                        <option>POS Indonesia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pilih Pembayaran</label>
                    <select id="pembayaran" class="form-control">
                        <option>BCA - XXXXXXX</option>
                        <option>BNI - XXXXXXX</option>
                        <option>BRI - XXXXXXX</option>
                        <option>MANDIRI - XXXXXXX</option>
                    </select>
                </div>

                <button type="submit" id="pesan-button"class="btn btn-sm btn-primary mb-3 " disabled  >Pesan</button>
            </form>
            <?php 
            }else{
                echo "<h4>Keranjang Belanja Anda Masih Kosong!";
            }
            ?>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>


<script>
    const namaInput = document.getElementById("nama");
    const alamatInput = document.getElementById("alamat");
    const teleponInput = document.getElementById("telepon");
    const metodeSelect = document.getElementById("metode");
    const pembayaranSelect = document.getElementById("pembayaran");
    const pesanButton = document.getElementById("pesan-button");

    // Fungsi untuk memeriksa apakah semua inputan di isi
    function checkInput() {
       return namaInput.value.trim() !== "" &&
              alamatInput.value.trim() !== "" &&
              teleponInput.value.trim() !== "" &&
              metodeSelect.value !== "" &&
              pembayaranSelect.value !== "";
    }

    // Event listener untuk inputan dan select
    namaInput.addEventListener("input", checkStatus);
    alamatInput.addEventListener("input", checkStatus);
    teleponInput.addEventListener("input", checkStatus);
    metodeSelect.addEventListener("change", checkStatus);
    pembayaranSelect.addEventListener("change", checkStatus);

    // Fungsi untuk memeriksa status tombol
    function checkStatus() {
      if (checkInput()) {
        pesanButton.disabled = false;
      } else {
        pesanButton.disabled = true;
      }
    }
  </script>
