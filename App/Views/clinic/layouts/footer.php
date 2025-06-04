    <footer class="container-fluid bg-blue text-white py-3">
        <div class="row gap-2">

            <div class="col-sm order-sm-1">
                <h1 class="h1">About Us</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa nesciunt repellendus itaque,
                    laborum
                    saepe
                    enim maxime, delectus, dicta cumque error cupiditate nobis officia quam perferendis consequatur
                    cum
                    iure
                    quod facere.</p>
            </div>
            <div class="col-sm order-sm-2">
                <h1 class="h1">Links</h1>
                <div class="links d-flex gap-2 flex-wrap">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="index.php?page=index" class="link text-white">Home</a>
                        <a href="index.php?page=majors" class="link text-white">Majors</a>
                        <a href="index.php?page=Doctors-index" class="link text-white">Doctors</a>
                        <a href="index.php?page=Contact" class="link text-white">Contact</a>
                        <a href="index.php?page=logout" class="link text-white">Logout</a>
                        <?=  strtoupper($_SESSION['user']['name'])?>
                    <?php else: ?>
                        <a href="index.php?page=login" class="link text-white">Login</a>
                        <a href="index.php?page=register" class="link text-white">Register</a>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"
        integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="assets/scripts/home.js"></script>

    </body>

    </html>