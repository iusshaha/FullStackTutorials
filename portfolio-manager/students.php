<?php
require_once 'functions.php';
require_once 'includes/header.php';

$students = [];
$error = '';

try {
    if (file_exists('students.txt')) {
        $lines = file('students.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            if (count($parts) === 3) {
                $students[] = [
                    'name' => $parts[0],
                    'email' => $parts[1],
                    'skills' => explode(', ', $parts[2])
                ];
            }
        }
    }
} catch (Exception $e) {
    $error = "Error reading student data: " . $e->getMessage();
}
?>

<h2>Registered Students</h2>

<?php if ($error): ?>
    <p><strong>ERROR:</strong> <?php echo $error; ?></p>
<?php endif; ?>

<?php if (empty($students)): ?>
    <p>No students registered yet. <a href="add_student.php">Add the first student</a></p>
<?php else: ?>
    <p><strong>Total Students:</strong> <?php echo count($students); ?></p>
    
    <hr>
    
    <?php foreach ($students as $index => $student): ?>
        <h3><?php echo ($index + 1) . ". " . htmlspecialchars($student['name']); ?></h3>
        <p>
            <strong>Email:</strong> 
            <a href="mailto:<?php echo htmlspecialchars($student['email']); ?>">
                <?php echo htmlspecialchars($student['email']); ?>
            </a>
        </p>
        <p>
            <strong>Skills:</strong><br>
            <?php foreach ($student['skills'] as $skill): ?>
                [<?php echo htmlspecialchars($skill); ?>] 
            <?php endforeach; ?>
        </p>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

<?php
require_once 'includes/footer.php';
?>