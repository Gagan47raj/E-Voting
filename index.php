<?php include 'includes/header.php' ?>
<?php include 'includes/connectdb.php' ?>


<?php
 if(isset($_POST['login']))
 {
    $voterId = $_POST['voterId'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $verify_query = "SELECT * FROM voter WHERE voterid = '{$voterId}' AND password = '{$password}' AND role='{$role}' ";
    $verify = mysqli_query($conn, $verify_query);

    if(mysqli_num_rows($verify)>0){
        $voterData = mysqli_fetch_array($verify);
        $groups = mysqli_query($conn, "SELECT * FROM voter WHERE role=2");
        $groupData = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        session_start();
        $_SESSION['voterData'] = $voterData;
        $_SESSION['groupData'] = $groupData;

        
        header("location://localhost/Voting App/home.php");
    }
    else
    {
        echo '
        <script>
         alert("Invalid Credentials or User not found!");
         window.location = "index.php";
        </script>
     ';
    }  
 }
?>



<div class="container mt-4">
    <div class="row">
        <h1>Voting App</h1>
    </div>
</div>

<div class="offset-md-4 col-md-4">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="mb-3">
            <label for="voterId" class="form-label">Voter ID</label>
            <input type="text" class="form-control" id="voterId" name="voterId">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="role">Roles</label>
            <select class="form-select ml-2" id="role" name="role">
                <option selected>Roles</option>
                <option value="1">Voter</option>
                <option value="2">Group</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" name="login">Login</button>
        <div class="form-group mx-2">
            Not have an account ? <span><a href="register.php">Register</a></span>
        </div>
    </form>
</div>


<?php include 'includes/footer.php' ?>