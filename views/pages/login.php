<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/navbar.css"> 
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: sans-serif;
        }
        .error-msg { color: red; margin-bottom: 15px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-msg">
                <?php 
                    if ($_GET['error'] === 'invalid_credentials') echo "wrong username or password.";
                    if ($_GET['error'] === 'missing_fields') echo "Please fill in all fields.";
                ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>