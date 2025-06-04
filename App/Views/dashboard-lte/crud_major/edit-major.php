<?php

use App\Models\Major;

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$major = Major::getById($pdo, $id);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clinic System :: Edit  Major</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="css/adminlte.min.css">
	<link rel="stylesheet" href="plugins/dropzone/dropzone.css">
	<link rel="stylesheet" href="css/custom.css">
	<style>
		.current-image {
			max-width: 200px;
			max-height: 200px;
			margin-top: 10px;
			border: 1px solid #ddd;
			border-radius: 4px;
			padding: 5px;
		}

		.image-container {
			margin-bottom: 15px;
		}
	</style>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
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
					<li class="breadcrumb-item"><a href="dashboard.php?page=majors">Majors</a></li>
					<li class="breadcrumb-item active">Edit</li>
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
						<h4 class="h4 mb-0"><strong>Admin User</strong></h4>
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
		<!-- /.navbar -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid my-2">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Edit  Major</h1>
						</div>
						<div class="col-sm-6 text-right">
							<a href="dashboard.php?page=majors" class="btn btn-warning">Back to Majors</a>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</section>
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="container-fluid">
					<?php if (isset($major)): ?>

						<form action="dashboard.php?page=Control-Major&action=major-edit" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?= $major->getId() ?>">

							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<label for="name">Major Name</label>
												<input type="text" name="name" id="name" class="form-control"
													value="<?= htmlspecialchars($major->getNameM()) ?>">
											</div>
										</div>

										<div class="col-md-12">
											<div class="mb-3">
												<label for="description">Description</label>
												<textarea name="description" id="description" class="form-control" rows="3"
													placeholder="Brief description of the specialty"><?= htmlspecialchars($major->getDescription()) ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card mt-3">
								<div class="card-body">
									<h4 class="h5 mb-3">Major Image</h4>

									<?php if ($major->getImage()): ?>
										<div class="image-container">
											<p>Current Image:</p>
											<img src="<?= htmlspecialchars($major->getImage()) ?>" class="current-image"
												alt="Current Major Image">

										</div>
									<?php endif; ?>

									<div class="mb-3">
										<label for="image">Upload New Image (Leave empty to keep current)</label>
										<input type="file" name="image" id="image" class="form-control-file" accept="image/*">
									</div>
								</div>
							</div>

							<div class="pb-5 pt-3">
								<button type="submit" class="btn btn-warning">Update Major</button>
								<a href="dashboard.php?page=majors" class="btn btn-dark">Cancel</a>
							</div>
						</form>
					<?php else: ?>
						<div class="alert alert-danger">لم يتم العثور على بيانات التخصص</div>
					<?php endif; ?>
				</div>
				<!-- /.card -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy; <?php echo date('Y'); ?> Clinic System. All rights reserved.</strong>
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="js/adminlte.min.js"></script>
	<!-- Dropzone JS -->
	<script src="plugins/dropzone/dropzone.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="js/demo.js"></script>


</body>

</html>