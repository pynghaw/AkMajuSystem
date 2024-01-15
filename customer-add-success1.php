<?php include 'headermainadmin.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Added Successfully</title>
</head>
<body>
    <div class="content-body">
        <div class="container-fluid">
            <!-- Your page content goes here -->

            <script>
                // JavaScript code to show a prompt
                alert("Customer Added Successfully");
                // Redirect to another page
                window.location.href = "customer-manage1.php"; // Change "index.php" to the desired page
            </script>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
