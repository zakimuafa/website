<div class="container-fluid">

<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_barang"><i class="fas fa-plus fa-sm"></i> Tambah Barang</button>

<table class="table table-bordered">
        <th>No</th>
        <th>Nama Barang</th>
        <th>Keterangan</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Gambar Produk</th>
        <th colspan="3">Aksi</th>
    </tr>

    <?php
    $no=1;
    foreach($barang as $brg) : ?>

    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $brg->nama_brg ?></td>
        <td><?php echo $brg->keterangan ?></td>
        <td><?php echo $brg->kategori ?></td>
        <td><?php echo $brg->harga ?></td>
        <td><?php echo $brg->stok ?></td>
        <td><img src="<?php echo base_url(). '/uploads/'.$brg->gambar ?>" class="card-img-top" style="width: 200px; height: 200px; object-fit: cover;"></td>
        <td><?php echo anchor('admin/data_barang/detail/' .$brg->id_brg, '<div class="btn btn-success btn-sm"><i class="fa fa-search"></i></div>') ?></td>
        <td><?php echo anchor('admin/data_barang/edit/' .$brg->id_brg, '<div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>') ?></td>
        <td><?php echo anchor('admin/data_barang/hapus/' .$brg->id_brg, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?></td>
    </tr>

    <?php endforeach; ?>

</table>

</div>

<!-- Modal -->
<div class="modal fade" id="tambah_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Input Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url(). 'admin/data_barang/tambah_aksi'; ?>" method="post" enctype="multipart/form-data" >

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_brg" class="form-control">
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control">
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="kategori">
              <option>Abaya</option>
              <option>Hijab</option>
            </select>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="text" name="harga" class="form-control">
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="text" name="stok" class="form-control">
        </div>

        <div class="form-group">
            <label>Gambar Produk</label><br>
            <input type="file" name="gambar" class="form-control">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

      </form>
    </div>
  </div>
</div>

<div class="card">
        <h5 class="card-header">Detail Produk</h5>
        <div class="card-body">

            <?php foreach($barang as $brg) : ?>
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo base_url(). '/uploads/'.$brg->gambar ?>" class="card-img-top">
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <td>Nama Produk</td>
                            <td><strong><?php echo $brg->nama_brg ?></strong></td>
                        </tr>

                        <tr>
                            <td>Keterangan</td>
                            <td><strong><?php echo $brg->keterangan ?></strong></td>
                        </tr>

                        <tr>
                            <td>Kategori</td>
                            <td><strong><?php echo $brg->kategori ?></strong></td>
                        </tr>

                        <tr>
                            <td>Stok</td>
                            <td><strong><?php echo $brg->stok ?></strong></td>
                        </tr>

                        <tr>
                            <td>Harga</td>
                            <td><strong><div class="btn btn-sm btn-success">Rp. <?php echo number_format($brg->harga, 0,',','.') ?></div></strong></td>
                        </tr>
                    </table>

                    <?php echo anchor('admin/data_barang/index/', '<div class="btn btn-sm btn-danger">Kembali</div>') ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>