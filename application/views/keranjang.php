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
    $no=1;
    foreach ($this->cart->contents() as $items) : ?>

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
        <td align="right" id="subtotal-<?php echo $items['rowid']; ?>"></td>
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
<a href="<?php echo base_url('dashboard/hapus_keranjang') ?>"><div class="btn btn-sm btn-danger">Hapus Keranjang</div></a>
<a href="<?php echo base_url('dashboard/lanjutkan_belanja') ?>"><div class="btn btn-sm btn-primary">Lanjutkan Belanja</div></a>
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

// Tambahkan event listener ke checkbox pertama
document.getElementById('checkbox1').addEventListener('change', function() {
  // Jika checkbox pertama di ceklis, maka ceklis semua checkbox lainnya
  for (var i = 1; i < checkboxes.length; i++) {
    if (checkboxes[i].id != 'checkbox1') {
      checkboxes[i].checked = this.checked;
      handleCheckboxChange(checkboxes[i]); // Handle change for each checkbox
    }
  }
  updateTotal(); // Update total after checkbox changes
  togglePembayaranButton(); // Toggle pembayaran button
});

// Tambahkan event listener ke checkbox lainnya
for (var i = 1; i < checkboxes.length; i++) {
  checkboxes[i].addEventListener('change', function() {
    handleCheckboxChange(this); // Handle the change
    updateTotal();
    togglePembayaranButton(); // Toggle pembayaran button
  });
}

// Function to handle checkbox change
function handleCheckboxChange(checkbox) {
  var rowid = checkbox.getAttribute('data-rowid');
  var qty = document.getElementById('qty-' + rowid).value;
  var price = <?php echo json_encode($this->cart->contents()); ?>[rowid]['price'];

  if (checkbox.checked) {
    var subtotal = qty * price;
    document.getElementById('subtotal-' + rowid).innerHTML = 'Rp. ' + subtotal.toLocaleString('id-ID');
  } else {
    document.getElementById('subtotal-' + rowid).innerHTML = ''; // Clear subtotal when unchecked
  }
}

// Update total
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

// Toggle pembayaran button based on checkbox status
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
    btnPembayaran.style.pointerEvents = 'auto'; // Aktifkan klik
    pembayaranBtn.classList.remove('disabled'); 
    btnPembayaran.href = "<?php echo base_url('dashboard/pembayaran') ?>"; // Redirect ke pembayaran
  } else {
    btnPembayaran.style.pointerEvents = 'none'; // Nonaktifkan klik
    pembayaranBtn.classList.add('disabled'); 
    btnPembayaran.href = "javascript:void(0)"; // Tetap tidak bisa diklik
  }
}
</script>
