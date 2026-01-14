<?php
include "db.php";
session_start();

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['teacher_id'];
$role = $_SESSION['teacher_role'];

// Determine which students to show
if ($role == 'class_teacher') {
    // Get class assigned to this teacher
    $teacher_class_query = mysqli_query($conn, "SELECT class FROM teacher_class WHERE teacher_id=$teacher_id");
    $teacher_class = mysqli_fetch_assoc($teacher_class_query)['class'];
    $students_query = mysqli_query($conn, "SELECT * FROM students WHERE class='$teacher_class'");
} else {
    // head_teacher / deputy can see all students
    $students_query = mysqli_query($conn, "SELECT * FROM students");
    $teacher_class = "All Classes";
}

// Handle form submission (only class teacher can mark attendance)
if ($role == 'class_teacher' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $today = date('Y-m-d');
    foreach ($_POST['status'] as $student_id => $status) {
        $student_id = intval($student_id);
        $status = mysqli_real_escape_string($conn, $status);

        $check = mysqli_query($conn, "SELECT * FROM attendance WHERE student_id=$student_id AND attendance_date='$today'");
        if (mysqli_num_rows($check) == 0) {
            mysqli_query($conn, "INSERT INTO attendance (student_id, teacher_id, attendance_date, status) VALUES ($student_id, $teacher_id, '$today', '$status')");
        }
    }
    echo "<p>Attendance for today saved successfully.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance - <?php echo $teacher_class; ?></title>
</head>
<body>
<h2>Attendance for <?php echo $teacher_class; ?> - Today</h2>

<?php if($role == 'class_teacher') { ?>
<form method="post">
<table border="1" cellpadding="5">
<tr>
    <th>Admission No</th>
    <th>Name</th>
    <th>Status</th>
</tr>

<?php while($student = mysqli_fetch_assoc($students_query)) { ?>
<tr>
    <td><?php echo $student['admission_no']; ?></td>
    <td><?php echo $student['first_name']." ".$student['last_name']; ?></td>
    <td>
        <select name="status[<?php echo $student['id']; ?>]">
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
    </td>
</tr>
<?php } ?>
</table>
<br>
<button type="submit">Save Attendance</button>
</form>
<?php } else { ?>
<p>All students are visible for review, but attendance marking is only allowed for class teachers.</p>
<table border="1" cellpadding="5">
<tr>
    <th>Admission No</th>
    <th>Name</th>
    <th>Class</th>
</tr>
<?php while($student = mysqli_fetch_assoc($students_query)) { ?>
<tr>
    <td><?php echo $student['admission_no']; ?></td>
    <td><?php echo $student['first_name']." ".$student['last_name']; ?></td>
    <td><?php echo $student['class']; ?></td>
</tr>
<?php } ?>
</table>
<?php } ?>

<p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
