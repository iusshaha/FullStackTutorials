<?php

/* ---------------------------
   Format student name
---------------------------- */
function formatName($name) {
    return ucwords(trim($name));
}

/* ---------------------------
   Validate email address
---------------------------- */
function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
    }
    return strtolower($email);
}

/* ---------------------------
   Clean skills string
---------------------------- */
function cleanSkills($skills) {
    return array_filter(array_map('trim', explode(',', $skills)));
}

/* ---------------------------
   Save student to students.txt
---------------------------- */
function saveStudent($name, $email, $skillsArray) {
    $data = $name . "|" . $email . "|" . implode(', ', $skillsArray) . "\n";
    file_put_contents('students.txt', $data, FILE_APPEND);
}

/* ---------------------------
   Upload portfolio file
---------------------------- */
function uploadPortfolioFile($file) {

    $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Upload error");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File too large (max 2MB)");
    }

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowedTypes)) {
        throw new Exception("Invalid file type");
    }

    $newFileName = time() . "_" . basename($file['name']);
    move_uploaded_file($file['tmp_name'], "uploads/" . $newFileName);

    return $newFileName;
}
