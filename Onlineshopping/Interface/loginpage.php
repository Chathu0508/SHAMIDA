<?php


include '.././Interface/Sharelayouts/header.php';

?>

<style type="text/css">
    .lognos {
        margin-top: 30px;
        padding-top: 20px;
        padding-bottom: 20px;
        width: 500px;
        height: 400px;
    }
</style>
<div class="container shadow-lg lognos">
    <div>
        <h2>Loginpage</h2>
    </div>

    <form action="loginpage.php" method="POST" name="staffadd">
        <div class="form-group">
            <label for="exampleInputEmail1">username</label>
            <br />
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter email" required>
            <br>
            <label for="exampleInputPassword1">Password</label>
            <br />
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
        </div>
        <br />
        <div class="d-grid gap-2">
            <input class="btn btn-secondary" type="submit" value="Submit" />
        </div>
    </form>
</div>
<?php include './../Interface/Sharelayouts/Footer.php';?>

<?php
if (isset($_POST["username"])) {
    $user = $_POST["username"];
    $pass = $_POST["pass"];

    include '../mysqldbconnection.php';

    $sql = "SELECT * FROM employee WHERE username = '" . $user . "' AND password='" . $pass . "' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_POST["username"] = NULL;

            $_SESSION["userName"] = $row['name'];
            $_SESSION["userId"] = $row['id'];
            $_SESSION["userType"] = $row['type'];
            echo "<script> alert('Welcome Mr. " . $row['name'] . "');  window.location.href='Dashboard.php';</script>";
            header("location: dashbaord.php");
            exit();
        }
    } else {
        echo "<script> alert('Error: Wrong username or password.');</script>";
    }
    $conn->close();
}
?>