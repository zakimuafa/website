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
        <td><div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off"></td>
        <td>
        <div class="input-group input-group-sm mb-3" style="width: 100px;">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary btn-sm btn-minus" type="button" data-rowid="<?php echo $items['rowid']; ?>">-</button>
            </div>
            <input type="text" class="form-control text-center qty-input" value="<?php echo $items['qty']; ?>" data-rowid="<?php echo $items['rowid']; ?>" readonly>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary btn-sm btn-plus" type="button" data-rowid="<?php echo $items['rowid']; ?>">+</button>
            </div>
        </div>
    </td>
    <td class="price" align="right" data-price="<?php echo $items['price']; ?>">Rp. <?php echo number_format($items['price'], 0, ',', '.'); ?></td>
    <td class="subtotal" align="right">Rp. <?php echo number_format($items['subtotal'], 0, ',', '.'); ?></td>
    <td>
        <a href="<?php echo base_url('dashboard/hapus_item_keranjang/' . $items['rowid']); ?>" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </a>
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