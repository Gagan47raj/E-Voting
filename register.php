<?php include 'includes/header.php' ?>
<?php include 'includes/connectdb.php' ?>


<?php
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $voterId = $_POST['voterId'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $pic = $_FILES["pic"]["name"];
    $temp_name = $_FILES["pic"]["tmp_name"];
    $role = $_POST['role'];

    $query_check = "SELECT * FROM voter WHERE email = '{$email}'";
    $res = mysqli_query($conn, $query_check);
    if (mysqli_num_rows($res) > 0) {
        echo "<div class='alert alert-danger'>Email Already Exists</div>";
    } else {
        if ($password === $cpassword) {
            move_uploaded_file($temp_name, "upload/$pic");
            $query_insert = "INSERT INTO voter (fullname, email, phone, voterid, password, photo, role, status, votes) 
                             VALUES ('{$fullname}', '{$email}', '{$phone}', '{$voterId}', '{$password}', '{$pic}', '{$role}', 0, 0)";

            if (mysqli_query($conn, $query_insert)) {
                echo '<script>
                        alert("Registered Successfully");
                        window.location = "index.php";
                      </script>';
            } else {
                echo '<script>
                        alert("Something went wrong!");
                        window.location = "register.php";
                      </script>';
            }
        } else {
            echo '<script>
                    alert("Password Mismatch!");
                    window.location = "register.php";
                  </script>';
        }
    }
}
?>




<div class="container mt-4">
    <div class="row">
        <h1>Voting App - Registration</h1>
    </div>
</div>

<div class="offset-md-4 col-md-4">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone">
        </div>
        <div class="mb-3">
            <label for="voterId" class="form-label">Voter ID</label>
            <input type="text" class="form-control" id="voterId" name="voterId">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="role">Roles</label>
            <select class="form-select ml-2" id="role" name="role">
                <option selected>Roles</option>
                <option value="1">Voter</option>
                <option value="2">Group</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pic" class="form-label">Upload Picture</label>
            <input type="file" class="form-control" id="pic" name="pic">
        </div>

        <button type="submit" class="btn btn-primary" name="register">Register</button>
        <div class="form-group mx-2">
            Already have an account ? <span><a href="index.php">Login</a></span>
        </div>
    </form>
</div>


<?php include 'includes/footer.php' ?>