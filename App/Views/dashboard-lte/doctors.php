<?php

use App\Models\Doctor;

$doctors = Doctor::getAll($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clinic Dashboard :: Doctors Management</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
    <style>
        .doctor-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .action-btns a {
            margin-right: 8px;
        }

        .table th {
            white-space: nowrap;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Doctors Management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Doctors</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Doctors List</h3>
                            <div class="card-tools">
                                <a href="dashboard.php?page=Create-Doctor" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New Doctor
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search doctors...">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Major</th>
                                            <th>Phone</th>
                                            <th>Fee</th>
                                            <th>Experience</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($doctors)): ?>
                                            <tr>
                                                <div class="alert alert-info">لم يتم العثور على دكتور. أنشئ دكتور الأول!</div>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($doctors as $doctor): ?>
                                                <tr>
                                                    <td><?= $doctor->getId() ?></td>
                                                    <td>
                                                        <img src="/329xampp/clinic-dashboard/public/uploads/<?= $doctor->getImage() ?>" alt="<?= $doctor->getImage() ?>" class="Major-image" width="120">
                                                    </td>
                                                    <td><?= htmlspecialchars($doctor->getName()) ?></td>

                                                    <td><?= htmlspecialchars($doctor->getMajorName()) ?></td>
                                                    <td><?= htmlspecialchars($doctor->getPhone()) ?></td>
                                                    <td>$<?= number_format($doctor->getConsultation_fee(), 2) ?></td>
                                                    <td><?= $doctor->getExperience_years() ?> years</td>
                                                    <td class="action-btns">
                                                        <a href="dashboard.php?page=Edit-Doctor&id=<?= $doctor->getId() ?>"
                                                            class="btn btn-primary btn-sm" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="dashboard.php?page=Control-Doctor&action=delete-doctor&id=<?= $doctor->getId() ?>"
                                                            class="btn btn-danger btn-sm" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this doctor?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2023 Clinic Management System.</strong> All rights reserved.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/adminlte.min.js"></script>
</body>

</html>