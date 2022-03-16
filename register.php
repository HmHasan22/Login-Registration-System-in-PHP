<?php include("./inc/header.php"); 
    include("./lib/User.php");
?>
<?php $user = new User();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
    $register = $user->userRegistration($_POST);
}

?>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <?php if(isset($register)){
                    echo $register;
                } ?>
                <nav class="navbar navbar-light bg-light px-4 my-4">
                    <a class="navbar-brand" href="#">Registration</a>
                </nav>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input required type="text" name="name" class="form-control" id="name" placeholder="Name">
                    </div>
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
                        <button name="register" type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>