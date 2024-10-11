<div class="container-fluid">
    <h3><i class="fas fa-edit"></i>Edit Data User</h3>

    <?php foreach($user as $usr) : ?>

        <form method="post" action="<?php echo base_url(). 'admin/data_user/update' ?>">

        <div class="form-group">
            <label>Nama</label>
            <input type="hidden" name="id" class="form-control" value="<?php echo $usr->id ?>">
            <input type="text" name="nama" class="form-control" value="<?php echo $usr->nama ?>">
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $usr->username ?>">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $usr->password ?>">
        </div>

        <div class="form-group">
            <label>Role</label>
            <input type="text" name="role_id" class="form-control" value="<?php echo $usr->role_id ?>">
        </div>

        <button type="submit" class="btn btn-primary btn-sm mt-3"> Simpan</button>

        </form>

    <?php endforeach; ?>
</div>