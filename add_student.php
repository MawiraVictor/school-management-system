<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adm  = $_POST["admission_no"];
    $fn   = $_POST["first_name"];
    $ln   = $_POST["last_name"];
    $cls  = $_POST["class"];
    $ph   = $_POST["parent_phone"];

    $sql = "INSERT INTO students
            (admission_no, first_name, last_name, class, parent_phone)
            VALUES ('$adm', '$fn', '$ln', '$cls', '$ph')";

    mysqli_query($conn, $sql);

    echo "<p>Student saved successfully </p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add student</title>
</head>
<body>
    <h2>Add student</h2>

    <form method="post">
        <label>Admission No</label><br>
        <input type="text" name="admission_no"><br><br>

        <label>First Name</label><br>
        <input type="text" name="first_name"><br><br>

        <label>Last Name</label><br>
        <input type="text" name="last_name"><br><br>

        <label>Class</label><br>
        <input type="text" name="class"><br><br>

        <label>Parent Phone</label><br>
        <input type="text" name="parent_phone"><br><br>

        <button type="submit">Save Students</button>
    </form>

    <p>
        <a href="students.php">View Students</a>
    </p>

</body>
</html>
