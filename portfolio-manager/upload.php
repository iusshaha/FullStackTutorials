<?php
require_once 'functions.php';
require_once 'includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!isset($_FILES['portfolio'])) {
            throw new Exception("No file selected");
        }

        $uploadedFile = uploadPortfolioFile($_FILES['portfolio']);
        $success = "File uploaded successfully! Saved as: $uploadedFile";

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<h2>Upload Portfolio File</h2>

<?php if ($success): ?>
    <p style="color:green;"><strong>SUCCESS:</strong> <?= $success ?></p>
<?php endif; ?>

<?php if ($error): ?>
    <p style="color:red;"><strong>ERROR:</strong> <?= $error ?></p>
<?php endif; ?>

<h3>Upload Requirements:</h3>
<ul>
    <li>Allowed formats: PDF, JPG, PNG</li>
    <li>Maximum file size: 2MB</li>
    <li>Files will be renamed automatically</li>
</ul>

<form method="POST" enctype="multipart/form-data">
    <label><strong>Select Portfolio File:</strong></label><br>
    <input type="file" name="portfolio" required><br><br>
    <button type="submit">Upload File</button>
</form>

<?php require_once 'includes/footer.php'; ?>
