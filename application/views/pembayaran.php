<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="btn btn-sm btn-success">
                <?php 
                // Ambil nilai grand_total dari session
                $grand_total = $this->session->userdata('grand_total');
                if ($grand_total) {
                    echo "<h4>Total Belanja Anda: Rp. " . number_format($grand_total, 0, ',', '.') . "</h4>";
                } else {
                    echo "<h4>Total Belanja Anda: Rp. 0</h4>";
                }
                ?>
            </div><br><br>

            <h3>Input Alamat Pengiriman dan Pembayaran</h3>

            <form method="post" action="<?php echo base_url() ?>dashboard/proses_pesanan">
                <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
                <input type="hidden" id="total_belanja" name="total_belanja" value="<?php echo $grand_total; ?>"> <!-- Input hidden untuk total belanja -->

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" placeholder="Nama Lengkap Anda" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <input type="text" name="alamat" id="alamat" placeholder="Alamat Lengkap Anda" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="no_telp" id="telepon" placeholder="Nomor Telepon Anda" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Metode Pengiriman</label>
                    <select id="metode" name="metode" class="form-control" required>
                        <option value="">-- Pilih Metode Pengiriman --</option>
                        <option>JNE</option>
                        <option>J&T</option>
                        <option>TIKI</option>
                        <option>Lalamove</option>
                        <option>POS Indonesia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Pembayaran</label>
                    <select id="pembayaran" name="pembayaran" class="form-control" required>
                        <option value="">-- Pilih Pembayaran --</option>
                        <option>BCA - XXXXXXX</option>
                        <option>BNI - XXXXXXX</option>
                        <option>BRI - XXXXXXX</option>
                        <option>MANDIRI - XXXXXXX</option>
                    </select>
                </div>

                <button type="submit" id="pesan-button" class="btn btn-sm btn-primary mb-3" disabled>Pesan</button>
            </form>
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

    function checkInput() {
       return namaInput.value.trim() !== "" &&
              alamatInput.value.trim() !== "" &&
              teleponInput.value.trim() !== "" &&
              metodeSelect.value !== "" &&
              pembayaranSelect.value !== "";
    }

    function checkStatus() {
      pesanButton.disabled = !checkInput();
    }

    namaInput.addEventListener("input", checkStatus);
    alamatInput.addEventListener("input", checkStatus);
    teleponInput.addEventListener("input", checkStatus);
    metodeSelect.addEventListener("change", checkStatus);
    pembayaranSelect.addEventListener("change", checkStatus);
</script>
