<nav class="navbar navbar-expand-lg navbar-expand-md bg-blue sticky-top">
    <div class="container">
        <div class="navbar-brand">
            <?php if (isset($_SESSION['user'])): ?>
            <a class="fw-bold text-white m-0 text-decoration-none h3" href="index.php?page=index">VCare</a>
        </div>
        <button class="navbar-toggler btn-outline-light border-0 shadow-none" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <div class="d-flex gap-3 flex-wrap justify-content-center" role="group">
                    <a type="button" class="btn btn-outline-light navigation--button" href="index.php?page=index">Home</a>
                    <a type="button" class="btn btn-outline-light navigation--button" href="index.php?page=majors">majors</a>
                    <a type="button" class="btn btn-outline-light navigation--button" href="index.php?page=Doctors-index">Doctors</a>
                    <a type="button" class="btn btn-outline-light navigation--button" ><?=  $_SESSION['user']['name']?></a>
                    <a type="button" class="btn btn-outline-light navigation--button" href="index.php?page=logout">logout</a>
                <?php else: ?>
                    <a type="button" class="btn btn-outline-light navigation--button" href="index.php?page=login">login</a>
                    <a type="button" class="btn btn-outline-light navigation--button" href="index.php?page=register">Register</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>