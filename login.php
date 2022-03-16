<?php

require("./inc/header.php");
include_once("./lib/User.php");

$user = new User();
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
    $userLogin = $user->userLogin($_POST);
    // var_dump($_POST);
    // $userLogin = $user
}

?>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <?php if(isset($userLogin)){
                    echo $userLogin;
                } ?>
                <nav class="navbar navbar-light bg-light px-4 my-4">
                    <a class="navbar-brand" href="#">Login</a>
                </nav>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input required type="email" name="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input required type="password" name="password" class="form-control" id="password"
                            placeholder="Password">
                    </div>
                    <div class="col-12">
                        <button name="submit" type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>