<?php
require_once "./partials/if-authenticated.php";
require_once "./partials/connection.php";

$sql = "SELECT * FROM `countries`;";
$result = $conn->query($sql);

$countries = $result->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h4>Dashboard</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./add-country.php" class="btn btn-outline-primary">Add Country</a>
                                <a href="./logout.php" class="btn btn-outline-danger">Logout</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        Welcome <strong><?php echo $_SESSION['user']['name'] ?></strong>

                        <?php
                        if ($result->num_rows !== 0) { ?>
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Capital</th>
                                        <th>Currency</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    // $sr = 1;
                                    // while($row = $result->fetch_assoc()) { 
                                    ?>
                                    <!-- <tr>
                                        <td><?php echo $sr++ ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['capital'] ?></td>
                                        <td><?php echo $row['currency'] ?></td>
                                        <td>
                                            <a href="" class="btn btn-primary">Edit</a>
                                            <a href="" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr> -->
                                    <?php
                                    // }
                                    ?>

                                    <?php
                                    $sr = 1;
                                    foreach ($countries as $country) { ?>
                                        <tr>
                                            <td><?php echo $sr++ ?></td>
                                            <td><?php echo $country['name'] ?></td>
                                            <td><?php echo $country['capital'] ?></td>
                                            <td><?php echo $country['currency'] ?></td>
                                            <td>
                                                <a href="./edit-country.php?id=<?php echo $country['id'] ?>" class="btn btn-primary">Edit</a>
                                                <a href="./delete-country.php?id=<?php echo $country['id'] ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        } else { ?>
                            <div class="alert alert-info m-0">No record found!</div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>