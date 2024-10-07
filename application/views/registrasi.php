<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg col-lg-6 my-5 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Daftar Akun!</h1>
                            </div>
                            <form method="post" action="<?php echo base_url('registrasi/index') ?>" class="user">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama" name="nama">
                                        <?php echo form_error('nama', '<div class="text-danger small ml-2">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username" placeholder="Username" name="username">
                                        <?php echo form_error('username', '<div class="text-danger small ml-2">', '</div>'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"id="password" placeholder="Password" name="password">
                                            <?php echo form_error('password', '<div class="text-danger small ml-2">', '</div>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="ulangi_password" placeholder="Ulangi Password" name="ulangi_password">
                                            <?php echo form_error('ulangi_passwordd', '<div class="text-danger small ml-2">', '</div>'); ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
                            </form>
                            <hr>b
                            <div class="text-center">
                                <a class="small" href="<?php echo base_url('auth/login') ?>">Sudah Punya Akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>