<?php
session_start();

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['teacher_role'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<h2>Welcome, <?php echo $_SESSION['teacher_name']; ?> (<?php echo $role; ?>)</h2>

<?php if($role == 'class_teacher') { ?>
    <p><a href="attendance.php">Mark Attendance (Your Class)</a></p>
    <p><a href="students.php">View Students (Your Class)</a></p>
<?php } else { ?>
    <!-- head_teacher / deputy -->
    <p><a href="attendance.php">Attendance (All Classes)</a></p>
    <p><a href="students.php">View All Students</a></p>
    <p><a href="teachers.php">View Teachers</a></p>
<?php } ?>

<p><a href="add_student.php">Add Student</a></p>
<p><a href="logout.php">Logout</a></p>
</body>
</html>
 