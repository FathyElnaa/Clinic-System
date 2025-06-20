    <?php

    use App\Models\Doctor;

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $doctor = Doctor::getById($pdo, $id);
    }
    ?>
    <div class="container">
      <nav
        style="--bs-breadcrumb-divider: '>'"
        aria-label="breadcrumb"
        class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
          <li class="breadcrumb-item">
            <a class="text-decoration-none" href="index.php?page=index">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a class="text-decoration-none" href="index.php?page=Doctors-index">doctors</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <?= htmlspecialchars($doctor->getName()) ?>
          </li>
        </ol>
      </nav>
      <div class="d-flex flex-column gap-3 details-card doctor-details">
        <div class="details d-flex gap-2 align-items-center">
          <img
            src="uploads/<?= $doctor->getImage() ?>"
            alt="doctor"
            class="img-fluid rounded-circle"
            width="150" />
          <div class="details-info d-flex flex-column gap-3">
            <h4 class="card-title fw-bold"><?= htmlspecialchars($doctor->getName()) ?></h4>
            <h6 class="card-title fw-bold">
              <?= htmlspecialchars($doctor->getMajorName()) ?>
            </h6>
          </div>
        </div>
        <hr />
        <form class="form" method="POST" action="index.php?page=Appointments-book">
          <input type="hidden" name="doctor_id" value="<?= $doctor->getId() ?>" />

          <div class="form-items">
            <div class="mb-3">
              <label class="form-label required-label" for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name"  />
            </div>
            <div class="mb-3">
              <label class="form-label required-label" for="phone">Phone</label>
              <input type="tel" class="form-control" id="phone" name="phone"  />
            </div>
            <div class="mb-3">
              <label class="form-label required-label" for="appointment_date">Appointment Date</label>
              <input type="datetime-local" name="appointment_date" class="form-control" id="appointment_date"  />
            </div>
            <div class="mb-3">
              <label class="form-label required-label" for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email"  />
            </div>
          </div>
          <button type="submit" class="btn btn-primary">
            Confirm Booking
          </button>
        </form>
      </div>
    </div>
    </div>