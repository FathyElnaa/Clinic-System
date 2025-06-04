<?php

use App\Models\Doctor;
use App\Models\Major;

$majors = Major::getAll($pdo);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $doctor = Doctor::getById($pdo, $id);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clinic System :: Edit Doctor</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="plugins/dropzone/dropzone.css">
    <link rel="stylesheet" href="css/custom.css">
    <style>
        .doctor-image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 4px;
        }

        .required-field::after {
            content: " *";
            color: red;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <div class="navbar-nav pl-2">
                <ol class="breadcrumb p-0 m-0 bg-white">
                    <li class="breadcrumb-item"><a href="dashboard.php?page=doctors">Doctors</a></li>
                    <li class="breadcrumb-item active">Edit Doctor</li>
                </ol>
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                        <img src="img/avatar5.png" class='img-circle elevation-2' width="40" height="40" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                        <h4 class="h4 mb-0"><strong>Admin</strong></h4>
                        <div class="mb-3">admin@clinic.com</div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user-cog mr-2"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-lock mr-2"></i> Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid my-2">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Doctor: <?= htmlspecialchars($doctor->getName()) ?></h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="dashboard.php?page=doctors" class="btn btn-primary">Back to Doctors</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <form action="dashboard.php?page=Control-Doctor&action=doctor-edit" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $doctor->getId() ?>">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="name" class="required-field">Full Name</label>
                                                    <input type="text" name="name" id="name" class="form-control"
                                                        value="<?= htmlspecialchars($doctor->getName()) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="required-field">Phone</label>
                                                    <input type="text" name="phone" id="phone" class="form-control"
                                                        value="<?= htmlspecialchars($doctor->getPhone()) ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <h4 class="h5 mb-3">Doctor Image</h4>
                                        <?php if ($doctor->getImage()): ?>
                                            <div class="mb-3">
                                                <img src="../public/uploads/<?= $doctor->getImage() ?>"
                                                    class="doctor-image-preview" id="imagePreview"
                                                    alt="Current Doctor Image">
                                                <div class="form-check">

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <label for="image">Change Image</label>
                                            <input type="file" name="image" id="image" class="form-control-file"
                                                onchange="previewImage(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3 required-field">Major</h2>
                                        <div class="mb-3">
                                            <select name="major_id" id="major_id" class="form-control">
                                                <option value="">Select Major</option>
                                                <?php foreach ($majors as $major): ?>
                                                    <option value="<?= $major->getId() ?>"
                                                        <?= $major->getId() == $doctor->getMajorId() ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($major->getNameM()) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3 required-field">Consultation Fee</h2>
                                        <div class="mb-3">
                                            <input type="number" name="consultation_fee" id="consultation_fee"
                                                class="form-control" placeholder="Fee in USD" step="0.01" min="0"
                                                value="<?= $doctor->getConsultation_fee() ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3 required-field">Experience (Years)</h2>
                                        <div class="mb-3">
                                            <input type="number" name="experience_years" id="experience_years"
                                                class="form-control" placeholder="Years of experience" min="0"
                                                value="<?= $doctor->getExperience_years() ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pb-5 pt-3">
                            <button type="submit" class="btn btn-primary">Update Doctor</button>
                            <a href="dashboard.php?page=doctors" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y') ?> Clinic System. All rights reserved.</strong>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/adminlte.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <script src="plugins/dropzone/dropzone.js"></script>

</body>

</html>