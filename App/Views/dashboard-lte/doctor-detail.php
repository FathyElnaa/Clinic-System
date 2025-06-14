<?php

use App\Models\Doctor;


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
	<title>Doctor Detail :: Administrative Panel</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="css/adminlte.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

	<!-- Content -->
	<div class="content-wrapper">
		<section class="content-header">					
			<div class="container-fluid my-2">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Doctor Detail: <?= htmlspecialchars($doctor->getName()) ?></h1>
					</div>
					<div class="col-sm-6 text-right">
						<a href="dashboard.php?page=doctors" class="btn btn-primary">Back</a>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-9">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Doctor Information</h3>
							</div>
							<div class="card-body">
								<table class="table table-bordered">
									<tr>
										<th>Name</th>
										<td><?= htmlspecialchars($doctor->getName()) ?></td>
									</tr>
									<tr>
										<th>Fee</th>
										<td>$<?= number_format($doctor->getConsultation_fee(),2)?></td>
									</tr>
									<tr>
										<th>Phone</th>
										<td><?= htmlspecialchars($doctor->getPhone()) ?></td>
									</tr>
									<tr>
										<th>Major</th>
										<td><?= htmlspecialchars($doctor->getMajorName()) ?></td>
									</tr>
									<tr>
										<th>Experience</th>
										<td><?= $doctor->getExperience_years() ?> years</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card">
							<div class="card-body">
								<h4>Doctor Actions</h4>
								<a href="dashboard.php?page=Edit-Doctor&id=<?= $doctor->getId()?>" class="btn btn-warning btn-block mb-2">Edit Doctor</a>
								<a href="dashboard.php?page=Control-Doctor&action=delete-doctor&id=<?= $doctor->getId()?>" class="btn btn-danger btn-block">Delete Doctor</a>
							</div>
						</div>

						<div class="card">
							<div class="card-body text-center">
								<img src="uploads/<?= $doctor->getImage() ?>" alt="Doctor Image" class="img-fluid img-circle mb-2" style="max-width: 150px;">
								<h5 class="mb-0"><?= htmlspecialchars($doctor->getName()) ?></h5>
								<small><?= htmlspecialchars($doctor->getMajorName()) ?></small>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
	</div>

	<footer class="main-footer">
		<strong>&copy; 2014-2025 AmazingShop. All rights reserved.</strong>
	</footer>

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/adminlte.min.js"></script>
</body>
</html>
