
<!doctype html>
<html lang="en">
    <head>
		<?php include 'include/head.php';
		?>
        <link rel="stylesheet" href="assets/css/signin.css">
    </head>

    <body class="text-center">
        <form class="form-signin">
            <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" name="username" class='form-control' id="fnama" required="isi" />
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" class='form-control' id="nim" required="isi" />
            <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            </div>
            <input type='submit' id='kirim' class="btn btn-primary" />
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
        </form>
    </body>
</html>
