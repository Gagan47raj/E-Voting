<?php include 'includes/header.php' ?>
<?php include 'includes/connectdb.php' ?>
<?php

session_start();
if (!isset($_SESSION['voterData'])) {
  header("location ://location/Voting App/index.php");
}

$voterData = $_SESSION['voterData'];
$groupData = $_SESSION['groupData'];

if($_SESSION['voterData']['status'] == 0)
{
  $status = '<b style="color:red;">Not Voted</b>';
}
else
{
  $status = '<b style="color:green;">Voted</b>';
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">E-Voting</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a class="btn btn-outline-success my-2 my-sm-0" href="./includes/logout.php">Logout</a>
    </form>
  </div>
</nav>

<div class="container mt-4">
  <div class="row">
    <h1>Voting App Home</h1>
  </div>
</div>

<div class="container mt-4" style="padding:20px; float:left; width:30%">

  <div class="card">
    <img src="./upload/<?php echo $voterData['photo'] ?>" height="150px" width="200px" class="card-img-top">
    <div class="card-body">
      <h5 class="card-title list-group-item">Name : <?php echo $voterData['fullname'] ?></h5>
      <h5 class="card-title list-group-item">Email : <?php echo $voterData['email'] ?></h5>
      <h5 class="card-title list-group-item">Phone : <?php echo $voterData['phone'] ?></h5>
      <h5 class="card-title list-group-item">Status : <?php echo $status ?></h5>
    </div>
  </div>
</div>

<div class="container mt-4" style="padding:20px; float:right; width:50%">
  <?php
  if ($_SESSION['groupData']) {
    for ($i = 0; $i < count($groupData); $i++) {
  ?>
      <div class="card" style="width: 30rem;">
        <img src="./upload/<?php echo $groupData[$i]['photo'] ?>" height="150px" width="200px" class="card-img-top">
        <div class="card-body">
          <h5 class="card-title list-group-item">Group Name : <?php echo $groupData[$i]['fullname'] ?></h5>
          <h5 class="card-title list-group-item">Votes : <?php echo $groupData[$i]['votes'] ?></h5>
          <form action="./includes/vote.php" method="POST">
            <input type="hidden" name="groupvotes" value="<?php echo $groupData[$i]['votes'] ?>">
            <input type="hidden" name="groupid" value="<?php echo $groupData[$i]['id'] ?>">
            <?php
            if($_SESSION['voterData']['status'] == 0)
            {
              ?>
              <input type="submit" name="votebtn" class="btn btn-primary mt-4" value="Vote">
              <?php
            }else
            {
              ?>
              <button disabled name="votebtn" class="btn btn-success mt-4">Voted</button>
              <?php
            }
            ?>
            
          </form>
        </div>
      </div>
      <hr>
  <?php
    }
  } else {
  }
  ?>
</div>
<?php include 'includes/footer.php' ?>