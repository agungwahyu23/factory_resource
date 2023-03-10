<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Factory Resource - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- CSS Sweet alert -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/select2/select2.min.css">

    <script src="<?= base_url() ?>assets/admin/vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Begin Page Content -->
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Log In Admin</h1>
                                        </div>
                                        <form class="user" id="login" method="POST">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="username"
                                                    name="username" placeholder="Enter Username...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="password" name="password" placeholder="Enter Password">
                                            </div>
                                            <button type="submit" class=" btn btn-login btn-primary btn-user btn-block">
                                                Log In
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <script type="text/javascript">
            $('#login').submit(function(e) {
                var data = $(this).serialize();
                // var data = new FormData($(this)[0]);
                $.ajax({
                        // method: 'POST',
                        beforeSend: function() {
                            $(".loading2").show();
                            $(".loading2").modal('show');
                        },
                        url: '<?php echo base_url('Auth/cek_login'); ?>',
                        type: "post",
                        enctype: "multipart/form-data",
                        // data: data,
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        cache: false,
                    })
                    .done(function(data) {
                        var result = jQuery.parseJSON(data);
                        console.log(data);
                        if (result.status == 'berhasil') {
                            document.getElementById("login").reset();
                            Swal.fire({
                                    type: 'success',
                                    title: 'Login Successful!',
                                    text: 'You will be redirected to dashboard'
                                });
								window.location.href =
                                        "<?php echo base_url('Dashboard') ?>";
                        } else {
                            $(".loading2").hide();
                            $(".loading2").modal('hide');
                            Swal.fire({
                                type: 'error',
                                title: 'Login Failed!',
                                text: 'Please try again!'
                            });

                        }
                    })
                e.preventDefault();
            });
            </script>

        </div>
        <!-- /.container-fluid -->


    </div>
    <!-- End of Page Wrapper -->
    <!-- Script -->
    <?php include('partials/script.php') ?>
    <!-- End Script -->

</body>

</html>
