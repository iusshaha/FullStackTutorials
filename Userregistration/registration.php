<?php
$name = "";
$email = "";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if ($name === "") {
        $errors["name"] = "Name is required";
    }

    if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Valid email required";
    }

    if ($password === "" || strlen($password) < 6) {
        $errors["password"] = "Password must be at least 6 characters";
    }

    if ($confirm !== $password) {
        $errors["confirm"] = "Passwords do not match";
    }

    if (empty($errors)) {

        $file = "users.json";

        if (!file_exists($file)) {
            file_put_contents($file, json_encode([]));
        }

        $data = json_decode(file_get_contents($file), true);

        $newUser = [
            "name"     => $name,
            "email"    => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ];

        $data[] = $newUser;

        if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT))) {
            $success = "Registration successful";
            $name = "";
            $email = "";
        } else {
            $errors["file"] = "Error saving user";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>

    <style>
        body {
            background: linear-gradient(135deg, #d6cfc4, #efe7da);
            font-family: Arial;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .container {
            background: #f5f1ea;
            padding: 30px;
            width: 360px;
            border-radius: 14px;
            border: 2px solid #8a7f6a;
            box-shadow: 0 10px 24px rgba(90, 75, 55, 0.25);
        }

        label {
            color: #4b3f2f;
            font-size: 14px;
            display: block;
            margin-top: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 10px;
            background: #e9e3d8;
            color: #3a3125;
            border: 1px solid #9a8f7a;
            border-radius: 8px;
            margin-top: 6px;
            transition: 0.25s;
        }

        input:focus {
            border-color: #6b7b3f;
            box-shadow: 0 0 0 3px rgba(107, 123, 63, 0.25);
            outline: none;
            background: #f3efe7;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #6b7b3f, #8b9a5b);
            color: #ffffff;
            border: none;
            margin-top: 22px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.25s;
        }

        button:hover {
            background: linear-gradient(135deg, #5a6934, #7b8a4c);
            transform: translateY(-1px);
        }

        .error {
            color: #9c2f2f;
            font-size: 13px;
            margin-top: 4px;
        }

        .success {
            background: #d9e4c8;
            color: #3f5a2c;
            padding: 12px;
            margin-bottom: 16px;
            text-align: center;
            border-radius: 8px;
            font-weight: bold;
            border: 1px solid #7f8f55;
        }
    </style>
</head>

<body>

<div class="container">

<?php if ($success): ?>
    <div class="success"><?php echo $success; ?></div>
<?php endif; ?>

<form action="" method="POST">

    <label>Name</label>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <div class="error"><?php echo $errors["name"] ?? ""; ?></div>

    <label>Email</label>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <div class="error"><?php echo $errors["email"] ?? ""; ?></div>

    <label>Password</label>
    <input type="password" name="password">
    <div class="error"><?php echo $errors["password"] ?? ""; ?></div>

    <label>Confirm Password</label>
    <input type="password" name="confirm">
    <div class="error"><?php echo $errors["confirm"] ?? ""; ?></div>

    <div class="error"><?php echo $errors["file"] ?? ""; ?></div>

    <button type="submit">Register</button>

</form>

</div>

<script>
    document.querySelectorAll("input").forEach(input => {
        input.addEventListener("focus", () => {
            input.style.borderColor = "#6b7b3f";
        });
    });
</script>

</body>
</html>
