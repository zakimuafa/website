<div class="container-fluid">
    <h4>Keranjang Belanja</h4>

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
            <th>Aksi</th> 
        </tr>

        <?php 
        $no=1;
        foreach ($this->cart->contents() as $items) : ?>

        <tr>
            <td><div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off"></td>
            <td><?php echo $items['name'] ?></td>
            <td>
                <div class="input-group input-group-sm mb-3" style="width: 100px;">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary btn-sm btn-minus" type="button" data-rowid="<?php echo $items['rowid'] ?>">-</button>
                    </div>
                    <input type="text" class="form-control text-center" value="<?php echo $items['qty'] ?>" data-rowid="<?php echo $items['rowid'] ?>" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-sm btn-plus" type="button" data-rowid="<?php echo $items['rowid'] ?>">+</button>
                    </div>
                </div>
            </td>
            <td align="right">Rp. <?php echo number_format($items['price'], 0,',','.') ?></td>
            <td align="right">Rp. <?php echo number_format($items['subtotal'], 0,',','.') ?></td>
            <td>
                <a href="<?php echo base_url('dashboard/hapus_item_keranjang/' . $items['rowid']) ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
            </td>
        </tr>

        <?php endforeach; ?>

        <tr>
            <td colspan="4"></td>
            <td align="right"><strong>Total: </strong> Rp. <?php echo number_format($this->cart->total(), 0,',','.') ?></td>
            <td></td>
        </tr>

    </table>

    <div align="right">
        <a href="<?php echo base_url('dashboard/hapus_keranjang') ?>"><div class="btn btn-sm btn-danger">Hapus Keranjang</div></a>
        <a href="<?php echo base_url('dashboard/lanjutkan_belanja') ?>"><div class="btn btn-sm btn-primary">Lanjutkan Belanja</div></a>
        <a href="<?php echo base_url('dashboard/pembayaran') ?>"><div class="btn btn-sm btn-success">Pembayaran</div></a>
    </div>
</div>

<script>
    // Select all checkboxes
var checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Add event listener to the first checkbox
document.getElementById('checkbox1').addEventListener('change', function() {
  // If the first checkbox is checked, check all other checkboxes
  if (this.checked) {
    for (var i = 1; i < checkboxes.length; i++) {
      checkboxes[i].checked = true;
    }
  } else {
    // If the first checkbox is unchecked, uncheck all other checkboxes
    for (var i = 1; i < checkboxes.length; i++) {
      checkboxes[i].checked = false;
    }
  }
});
    $(document).ready(function() {
        $('.btn-plus, .btn-minus').on('click', function(e) {
            e.preventDefault();

            var $button = $(this);
            var rowid = $button.data('rowid');
            var qtyInput = $('input[data-rowid="' + rowid + '"]');
            var currentQty = parseInt(qtyInput.val());

            if ($button.hasClass('btn-plus')) {
                qtyInput.val(currentQty + 1);