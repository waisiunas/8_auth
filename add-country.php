<?php
require_once "./partials/if-authenticated.php";
require_once "./partials/connection.php";

$name = $capital = $currency = "";
$errors = [];
if (isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST['name']);
    $capital = htmlspecialchars($_POST['capital']);
    $currency = htmlspecialchars($_POST['currency']);

    if (empty($name)) {
        $errors['name'] = "Provide country name!";
    }

    if (empty($capital)) {
        $errors['capital'] = "Provide country capital!";
    }

    if (empty($currency)) {
        $errors['currency'] = "Provide country currency!";
    }

    if (count($errors) === 0) {
        $sql = "INSERT INTO `countries`(`name`, `capital`, `currency`) VALUES ('$name', '$capital', '$currency');";
        if ($conn->query($sql)) {
            $success = "Magic has been spelled!";
            $name = $capital = $currency = "";
        } else {
            $failure = "Magic has become shopper!";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Country</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="m-0">Add Country</h2>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./dashboard.php" class="btn btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            <?php
                            if (isset($success)) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $success ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            }

                            if (isset($failure)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $failure ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" placeholder="Country name!" class="form-control <?php if (isset($errors['name'])) echo "is-invalid" ?>" value="<?php echo $name ?>">
                                <?php
                                if (isset($errors['name'])) { ?>
                                    <div class="text-danger">
                                        <?php echo $errors['name'] ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="capital" class="form-label">Capital</label>
                                <input type="text" id="capital" name="capital" placeholder="Country capital!" class="form-control form-control <?php if (isset($errors['capital'])) echo "is-invalid" ?>" value="<?php echo $capital ?>">
                                <?php
                                if (isset($errors['capital'])) { ?>
                                    <div class="text-danger">
                                        <?php echo $errors['capital'] ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <input type="text" id="currency" name="currency" placeholder="Country currency!" class="form-control form-control <?php if (isset($errors['currency'])) echo "is-invalid" ?>" value="<?php echo $currency ?>">
                                <?php
                                if (isset($errors['currency'])) { ?>
                                    <div class="text-danger">
                                        <?php echo $errors['currency'] ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div>
                                <input type="submit" name="submit" value="Add" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>