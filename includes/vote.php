<?php include'connectdb.php'?>

<?php
session_start();
$votes = $_POST['groupvotes'];
$total_votes = $votes+1;
$group_id = $_POST['groupid'];
$voterid = $_SESSION['voterData']['id'];

$update_votes = mysqli_query($conn, "UPDATE voter SET votes = '$total_votes' where id='$group_id' ");
$update_voter_status = mysqli_query($conn, "UPDATE voter SET status = 1 WHERE id='$voterid' ");

if($update_votes AND $update_voter_status)
{
    $groups = mysqli_query($conn, "SELECT id,fullname,votes,photo FROM voter WHERE role = 2");
    $groupData = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    
    $_SESSION['voterData']['status'] = 1;
    $_SESSION['groupData'] = $groupData;

    echo '
        <script>
         alert("Voted Successfully");
         window.location = "../home.php";
        </script>
     ';
}
else
{
    echo '
        <script>
         alert("Something went wrong");
         window.location = "home.php";
        </script>
     ';
}
?>