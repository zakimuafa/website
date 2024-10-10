<table class="table table-bordered table-striped table-hover">
    <tr>
        <th><div class="form-check">
        <input class="form-check-input" type="checkbox" id="checkbox1" name="checkbox1">
        <label class="form-check-label" for="checkbox1">Produk</label>
        </div></th>
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
        <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
    </td>  
           <td><?php echo $items['name'] ?></td>
            <td>
            <input type="number" id="qty-<?php echo $items['rowid']; ?>" name="qty" min="1" value="<?php echo $items['qty']; ?>" style="width: 40px;">
            </td>
            <td align="right">Rp. <?php echo number_format($items['price'], 0,',','.') ?></td>
            <td align="right">Rp. <?php echo number_format($items['subtotal'], 0,',','.') ?></td>
        </tr>

    <?php endforeach; ?>

    <tr>
        <td colspan="4"></td>
        <td align="right">Rp. <?php echo number_format($this->cart->total(), 0,',','.') ?></td>
    </tr>

</table>

<div align="right">
    <a href="<?php echo base_url('dashboard/hapus_keranjang') ?>"><div class="btn btn-sm btn-danger">Hapus Keranjang</div></a>
    <a href="<?php echo base_url('dashboard/lanjutkan_belanja') ?>"><div class="btn btn-sm btn-primary">Lanjutkan Belanja</div></a>
    <a href="<?php echo base_url('dashboard/pembayaran') ?>"><div class="btn btn-sm btn-success">Pembayaran</div></a>
</div>

<script>
    // Pilih semua checkbox
var checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Tambahkan event listener ke checkbox pertama
document.getElementById('checkbox1').addEventListener('change', function() {
  // Jika checkbox pertama di ceklis, maka ceklis semua checkbox lainnya
  if (this.checked) {
    for (var i = 1; i < checkboxes.length; i++) {
      if (checkboxes[i].id != 'checkbox1') {
        checkboxes[i].checked = true;
      }
    }
  } else {
    // Jika checkbox pertama tidak di ceklis, maka hapus ceklis semua checkbox lainnya
    for (var i = 1; i < checkboxes.length; i++) {
      if (checkboxes[i].id != 'checkbox1') {
        checkboxes[i].checked = false;
      }
    }
  }
});
</script>




