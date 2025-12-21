<?php
require_once 'includes/header.php';
require_once 'functions.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $skills = $_POST['skills'] ?? '';

        if (empty($name) || empty($email) || empty($skills)) {
            throw new Exception("All fields are required");
        }

        $formattedName = formatName($name);
        $validatedEmail = validateEmail($email);
        $skillsArray = cleanSkills($skills);

        if (empty($skillsArray)) {
            throw new Exception("Please enter at least one skill");
        }

        saveStudent($formattedName, $validatedEmail, $skillsArray);
        $success = "Student added successfully! Name: $formattedName";

        $_POST = [];

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<h2>Add New Student</h2>

<?php if ($success): ?>
    <p style="color:green;"><strong>SUCCESS:</strong> <?= $success ?></p>
<?php endif; ?>

<?php if ($error): ?>
    <p style="color:red;"><strong>ERROR:</strong> <?= $error ?></p>
<?php endif; ?>

<form method="POST">
    <p>
        <label><strong>Student Name:</strong></label><br>
        <input type="text" name="name" required>
    </p>

    <p>
        <label><strong>Email Address:</strong></label><br>
        <input type="email" name="email" required>
    </p>

    <p>
        <label><strong>Skills (comma-separated):</strong></label><br>
        <input type="text" name="skills" required>
    </p>

    <button type="submit">Add Student</button>
</form>

<?php require_once 'includes/footer.php'; ?>
