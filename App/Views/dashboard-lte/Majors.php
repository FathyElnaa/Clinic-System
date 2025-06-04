<?php

use App\Models\Major;

$majors = Major::getAll($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clinic System :: Medical Majors</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="css/adminlte.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<style>
		.status-icon {
			width: 24px;
			height: 24px;
		}

		.action-icons a {
			margin-right: 10px;
		}

		.table-responsive {
			min-height: 300px;
		}

		.Major-image {
			width: 50px;
			height: 50px;
			object-fit: cover;
			border-radius: 4px;
		}
	</style>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid my-2">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Majors</h1>
						</div>
						<div class="col-sm-6 text-right">
							<a href="dashboard.php?page=Create-Major" class="btn btn-primary">
								<i class="fas fa-plus-circle mr-1"></i> Add New Major
							</a>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="container-fluid">
					<div class="card">
						<div class="card-header">
							<div class="card-tools">
								<div class="input-group input-group" style="width: 250px;">
									<input type="text" id="searchInput" class="form-control float-right" placeholder="Search Majors...">
									<div class="input-group-append">
										<button type="button" class="btn btn-default" id="searchBtn">
											<i class="fas fa-search"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body table-responsive p-0">
							<?php if (empty($majors)): ?>
								<div class="alert alert-info">لم يتم العثور على تخصصات. أنشئ تخصصك الأول!</div>
							<?php else: ?>

								<table class="table table-hover">
									<thead>
										<tr>
											<th width="60">ID</th>
											<th>Image</th>
											<th>Name</th>
											<th>Description</th>
											<th width="150">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($majors as $major): ?>
											<tr>
												<td><?= $major->getId() ?></td>
												<td>
													<img src="/329xampp/clinic-dashboard/public/uploads/<?= $major->getImage() ?>" alt="<?= $major->getNameM() ?>" class="Major-image">
												</td>
												<td><?= $major->getNameM() ?></td>
												<td><?= $major->getDescription() ?></td>

												<td class="action-icons">
													<a href="dashboard.php?page=Edit-Major&id=<?= $major->getId() ?>" class="text-primary" title="Edit">
														<i class="fas fa-edit fa-lg"></i>
													</a>
													<a href="dashboard.php?page=Control-Major&action=major-delete&id=<?= $major->getId() ?>" class="text-danger" title="Delete" onclick="confirmDelete(1)">
														<i class="fas fa-trash-alt fa-lg"></i>
													</a>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							<?php endif ?>
						</div>

					</div>
				</div>
			</section>
		</div>

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
	<!-- SweetAlert2 -->
	<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

</body>

</html>