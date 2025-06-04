<?php
use App\Models\Doctor;

$doctors = [];
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $doctors = Doctor::getByMajorId($pdo, $id);
}
?>

<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="index.php?page=index">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">doctors</li>
        </ol>
    </nav>
    <div class="doctors-grid">
    <?php if (!empty($doctors)): ?>
        <?php foreach ($doctors as $doctor): ?>
            <div class="card p-2" style="width: 18rem;">
                <img src="uploads/<?= $doctor->getImage() ?>" class="card-img-top rounded-circle card-image-circle" alt="doctor">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center"><?= $doctor->getName() ?></h4>
                    <h6 class="card-title fw-bold text-center"><?= $doctor->getMajorName() ?></h6>
                    <a href="index.php?page=Doctor&id=<?= $doctor->getId() ?>" class="btn btn-outline-primary card-button">Book an appointment</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">لم يتم العثور على أطباء لهذا التخصص.</p>
    <?php endif; ?>
</div>


    <nav class="mt-5" aria-label="navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link page-prev" href="#" aria-label="Previous">
                    <span aria-hidden="true">
                        < </span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link page-next" href="#" aria-label="Next">
                    <span aria-hidden="true"> > </span>
                </a>
            </li>
        </ul>
    </nav>
</div>
</div>