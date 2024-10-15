<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox1" name="checkbox1">
                <label class="form-check-label" for="checkbox1">Produk</label>
            </div>
        </th>
        <th>Nama Produk</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Sub-Total</th>
    </tr>

    <?php 
    $no = 1;
    $grand_total = 0;  // Hitung total belanja

    // Loop untuk setiap item di keranjang
    foreach ($this->cart->contents() as $items) : 
        $grand_total += $items['subtotal'];  // Tambahkan subtotal item ke grand total
        // Setelah menghitung grand_total
$this->session->set_userdata('grand_total', $grand_total);
    ?>



    <tr>
        <td>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="checkbox" class="btn-check" id="btncheck<?php echo $no; ?>" autocomplete="off" data-rowid="<?php echo $items['rowid']; ?>">
            </div>
        </td>
        <td><?php echo $items['name'] ?></td>
        <td>
            <input type="number" id="qty-<?php echo $items['rowid']; ?>" name="qty" min="1" value="<?php echo $items['qty']; ?>" style="width: 40px;">
        </td>
        <td align="right">Rp. <?php echo number_format($items['price'], 0,',','.') ?></td>
        <td align="right" id="subtotal-<?php echo $items['rowid']; ?>">
      
        </td>
    </tr>

    <?php 
    $no++;
    endforeach; 
    ?>

    <tr>
        <td colspan="4"></td>
        <td align="right" id="total">Rp. 0</td>
    </tr>
</table>

<div align="right">
    <a href="#" onclick="confirmDelete()">
        <div class="btn btn-sm btn-danger">Hapus Keranjang</div>
    </a>
    <script>
    function confirmDelete() {
        const confirmation = confirm("Apakah Anda yakin ingin menghapus keranjang?");

        if (confirmation) {
            // Redirect to the delete action if the user confirms
            window.location.href = "<?php echo base_url('dashboard/hapus_keranjang'); ?>";
        }
    }
    </script>

    <a href="<?php echo base_url('dashboard/lanjutkan_belanja') ?>">
        <div class="btn btn-sm btn-primary">Lanjutkan Belanja</div>
    </a>
    <a href="javascript:void(0)" id="btnPembayaran">
        <div class="btn btn-sm btn-success disabled" id="pembayaranBtn">Pembayaran</div>
    </a>
</div>

<script>
// Disable pembayaran button by default
document.getElementById('btnPembayaran').style.pointerEvents = 'none';
document.getElementById('btnPembayaran').classList.add('disabled');

// Pilih semua checkbox
var checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Tambahkan event listener ke checkbox pertama (Select All)
document.getElementById('checkbox1').addEventListener('change', function() {
    for (var i = 1; i < checkboxes.length; i++) {
        if (checkboxes[i].id != 'checkbox1') {
            checkboxes[i].checked = this.checked;
            handleCheckboxChange(checkboxes[i]);
        }
    }
    updateTotal(); 
    togglePembayaranButton(); 
});

// Event listener untuk checkbox lainnya
for (var i = 1; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function() {
        handleCheckboxChange(this); 
        updateTotal();
        togglePembayaranButton();
    });
}

// Function untuk mengubah checkbox
function handleCheckboxChange(checkbox) {
    var rowid = checkbox.getAttribute('data-rowid');
    var qty = document.getElementById('qty-' + rowid).value;
    var price = <?php echo json_encode($this->cart->contents()); ?>[rowid]['price'];

    if (checkbox.checked) {
        var subtotal = qty * price;
        document.getElementById('subtotal-' + rowid).innerHTML = 'Rp. ' + subtotal.toLocaleString('id-ID');
    } else {
        document.getElementById('subtotal-' + rowid).innerHTML = ''; // Kosongkan subtotal jika checkbox tidak dicentang
    }
}

// Update total belanja
function updateTotal() {
    var total = 0;
    for (var i = 1; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            var rowid = checkboxes[i].getAttribute('data-rowid');
            var qty = document.getElementById('qty-' + rowid).value;
            var price = <?php echo json_encode($this->cart->contents()); ?>[rowid]['price'];
            total += qty * price;
        }
    }
    document.getElementById('total').innerHTML = 'Rp. ' + total.toLocaleString('id-ID');
}

// Toggle pembayaran button berdasarkan status checkbox
function togglePembayaranButton() {
    var isAnyChecked = false;
    for (var i = 1; i < checkboxes.length; i++) { 
        if (checkboxes[i].checked) {
            isAnyChecked = true;
            break;
        }
    }

    var btnPembayaran = document.getElementById('btnPembayaran');
    var pembayaranBtn = document.getElementById('pembayaranBtn');
    
    if (isAnyChecked) {
        btnPembayaran.style.pointerEvents = 'auto'; // Aktifkan tombol pembayaran
        pembayaranBtn.classList.remove('disabled');
        btnPembayaran.href = "<?php echo base_url('dashboard/pembayaran') ?>"; // Redirect ke halaman pembayaran
    } else {
        btnPembayaran.style.pointerEvents = 'none'; // Nonaktifkan tombol pembayaran
        pembayaranBtn.classList.add('disabled'); 
        btnPembayaran.href = "javascript:void(0)"; // Tetap tidak bisa diklik
    }
}
</script>
