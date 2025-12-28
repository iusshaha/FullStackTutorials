<?php
require 'db.php';


$sql = "SELECT * FROM students";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student List</title>
</head>
<body>

<h1>Student List</h1>

<a href="create.php">Add New Student</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Action</th>
    </tr>

    <?php foreach ($students as $student): ?>
    <tr>
        <td><?= $student['id']; ?></td>
        <td><?= $student['name']; ?></td>
        <td><?= $student['email']; ?></td>
        <td><?= $student['course']; ?></td>
        <td>
            <a href="edit.php?id=<?= $student['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?= $student['id']; ?>" 
               onclick="return confirm('Delete this student?');">
               Delete
            </a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
