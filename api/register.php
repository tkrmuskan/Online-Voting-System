<?php
include("connect.php");

$name = $_POST['name'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$password = $_POST['password'] ?? '';
$cpassword = $_POST['cpassword'] ?? '';
$address = $_POST['address'] ?? '';
$image = $_FILES['photo']['name'] ?? '';
$tmp_name = $_FILES['photo']['tmp_name'] ?? '';
$role = $_POST['role'] ?? '';


if (empty($name) || empty($mobile) || empty($password) || empty($cpassword) || empty($address) || empty($image) || empty($role)) {
    echo '
    <script>
        alert("Please fill in all fields.");
        window.location = "../routes/register.html";
    </script>
    ';
    exit;
}

if ($password == $cpassword) {
    $destination = "../uploads/$image";
    if (move_uploaded_file($tmp_name, $destination)) {
        $query = "INSERT INTO users (name, mobile, address, password, photo, role, status, votes) VALUES ('$name', '$mobile', '$address', '$password', '$image', '$role', 0, 0)";
        $insert = mysqli_query($connect, $query);
        if ($insert) {
            echo '
            <script>
                alert("Registration successful!");
                window.location = "../";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Some error occurred: ' . mysqli_error($connect) . '");
                window.location = "../routes/register.html";
            </script>
            ';
        }
    } else {
        echo '
        <script>
            alert("File upload failed!");
            window.location = "../routes/register.html";
        </script>
        ';
    }
} else {
    echo '
    <script>
        alert("Password and Confirm password do not match!");
        window.location = "../routes/register.html";
    </script>
    ';
}
?>
