<?php
require_once 'includes/header.php';
?>

<h2>Welcome to Student Portfolio Manager</h2>

<p>This application helps you manage student information and their portfolio files.</p>

<h3>Features:</h3>
<ul>
    <li>Add student information with name, email, and skills</li>
    <li>Upload portfolio files (PDF, JPG, PNG)</li>
    <li>View all registered students</li>
    <li>Automatic email and data validation</li>
    <li>Secure file handling with size and type restrictions</li>
</ul>

<h3>Quick Links:</h3>
<p>
    <a href="add_student.php">Add New Student</a> | 
    <a href="upload.php">Upload Portfolio</a> | 
    <a href="students.php">View All Students</a>
</p>

<?php
require_once 'includes/footer.php';
?>