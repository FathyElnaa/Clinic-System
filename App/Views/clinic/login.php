<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="index.php?page=index">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">login</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form  mx-auto mt-5">
        <form action="index.php?page=sign-in" method="post">

            <div class="mb-3">
                <label class="form-label required-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="mb-3">
                <label class="form-label required-label" for="password">password</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="d-flex justify-content-center gap-2 flex-column flex-lg-row flex-md-row flex-sm-column">
            <span>don't have an account?</span><a class="link" href="index.php?page=register">create account</a>
        </div>
    </div>

</div>
</div>