<?php
require 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    try {
        $name   = $_POST['name'];
        $email  = $_POST['email'];
        $course = $_POST['course'];

        $sql = "UPDATE students SET name=?, email=?, course=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $course, $id]);

        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("Update failed " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h1>Edit Student</h1>

<form method="POST">
    Name: <input type="text" name="name" value="<?= $student['name']; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $student['email']; ?>" required><br><br>
    Course: <input type="text" name="course" value="<?= $student['course']; ?>" required><br><br>
    <button type="submit">Update</button>
</form>

</body>
</html>
