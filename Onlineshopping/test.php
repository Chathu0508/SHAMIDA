<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Generate Random Number in PHP</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg">
                    <h1>Generate Random Number in PHP</h1>
                </div>
                <div class="card-body">
                    <form method="post">
                        Min: <input type="number" name="min" min="0" value="1" class="form-control"><br>
                        Max: <input type="number" name="max" min="1" value="1000" class="form-control"><br>
                        <input type="submit" name="submit" class="btn btn-primary" value="Generate">
                    </form>
                    <label>Name of the customer : </label><br>
                    <input class="form-control" type="text" name="cuname" id="cuname" value="" required />

                    <br />

                    <br>
                    <?php
                    if (isset($_POST['submit'])) {
                        $min = $_POST['min'];
                        $max = $_POST['max'];
                        $rand_num = rand($min, $max);
                        echo "<h4>Random Number between " . $min . " and " . $max . " is " . $rand_num . "</h4>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>