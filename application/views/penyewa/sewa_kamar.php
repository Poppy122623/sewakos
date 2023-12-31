<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Penyewa - Sewa</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>assets/dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dashboard/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.css"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="<?php echo site_url('penyewa/dashboard'); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Sewa Kos </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item ">
                <a class="nav-link" href="<?php echo site_url('penyewa/dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link" href="<?php echo site_url('penyewa/profil'); ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data Penyewa</span></a>
            </li>


            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sewa Kos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo site_url('penyewa/sewakamar'); ?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Sewa Kamar</span></a>

                <a class="nav-link" href="<?php echo site_url('penyewa/tagihan'); ?>">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Tagihan</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $username; ?>
                                </span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Sewa Kamar</h1>
                    </div>
                    <?php echo $this->session->flashdata('msg_info'); ?>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">

                                    <a href="<?php echo site_url('penyewa/createsewakamar'); ?>"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        Buat Sewa Kamar</a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama Penyewa</th>
                                                    <th>Tanggal Awal</th>
                                                    <th>Tanggal Akhir</th>
                                                    <th>No Kamar</th>
                                                    <th>Status Sewa</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama Penyewa</th>
                                                    <th>Tanggal Awal</th>
                                                    <th>Tanggal Akhir</th>
                                                    <th>No Kamar</th>
                                                    <th>Status Sewa</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php if (!empty($sewakamar)): ?>
                                                <?php foreach ($sewakamar as $sewa): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $sewa['nama_penyewa']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $sewa['tanggal_awal']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $sewa['tanggal_akhir']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $sewa['no_kamar']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                                if ($sewa['status_sewa'] == 'Y') {
                                                                    echo 'Aktif';
                                                                } else {
                                                                    echo 'Non Aktif';
                                                                }
                                                                ?>
                                                    </td>
                                                    <td> <a href="<?php echo site_url('penyewa/edit_sewa/') . $sewa['id_sewa']; ?>"
                                                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                                            Edit</a>
                                                        <a href="<?php echo site_url('penyewa/hapus_sewa/') . $sewa['id_sewa']; ?>"
                                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm delete-link"
                                                            data-id="<?php echo $sewa['id_sewa']; ?>">Delete</a>


                                                    </td> <!-- Anda perlu menambahkan aksi sesuai kebutuhan -->
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td colspan="6">Tidak ada data sewa kamar.</td>
                                                </tr>
                                                <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; 11230019-Poppy Lestari 2023</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin logout?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?php echo site_url('login/sign_out'); ?>">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="<?php echo base_url(); ?>assets/dashboard/vendor/jquery/jquery.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js">
            </script>

            <!-- Core plugin JavaScript-->
            <script src="<?php echo base_url(); ?>assets/dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="<?php echo base_url(); ?>assets/dashboard/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="<?php echo base_url(); ?>assets/dashboard/vendor/chart.js/Chart.min.js"></script>

            <!-- Page level plugins -->
            <script src="<?php echo base_url(); ?>assets/dashboard/vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.js">
            </script>

            <!-- Page level custom scripts -->
            <script src="<?php echo base_url(); ?>assets/dashboard/js/demo/chart-area-demo.js"></script>
            <script src="<?php echo base_url(); ?>assets/dashboard/js/demo/chart-pie-demo.js"></script>
            <!-- Page level custom scripts -->
            <script src="<?php echo base_url(); ?>assets/dashboard/js/demo/datatables-demo.js"></script>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteLinks = document.querySelectorAll('.delete-link');

                deleteLinks.forEach(link => {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();

                        const idSewa = this.getAttribute('data-id');
                        const confirmed = confirm(
                            'Apakah Anda yakin ingin menghapus data sewa ini?');

                        if (confirmed) {

                            window.location.href =
                                '<?php echo site_url('penyewa/hapus_sewa/'); ?>' + idSewa +
                                '?confirmed=true';
                        }
                    });
                });
            });
            </script>


</body>

</html>