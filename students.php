<?php
include "db.php";

$result = mysqli_query($conn, "SELECT * FROM students");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
</head>
<body>

<h2>Student List</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Admission No</th>
        <th>Name</th>
        <th>Class</th>
        <th>Parent Phone</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['admission_no']; ?></td>
        <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
        <td><?php echo $row['class']; ?></td>
        <td><?php echo $row['parent_phone']; ?></td>
    </tr>
    <?php } ?>
</table>

<br>

<a href="add_student.php">Add New Student</a>

</body>
</html>
