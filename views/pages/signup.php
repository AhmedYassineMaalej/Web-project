<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PickPocket | Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/style.css" />
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">
                <img src="https://staging.svgrepo.com/show/15477/coin.svg" alt="Logo" width="40" height="30" class="d-inline-block align-text-center" />
                PickPocket
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white text-center pt-4 pb-3 border-0">
                        <h2 class="fw-bold text-primary">Create Account</h2>
                        <p class="text-muted">Join PickPocket today</p>
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- Error Messages -->
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php 
                                    $error = $_GET['error'];
                                    $message = '';
                                    switch($error) {
                                        case 'empty_fields':
                                            $message = 'Please fill in all fields.';
                                            break;
                                        case 'password_mismatch':
                                            $message = 'Passwords do not match.';
                                            break;
                                        case 'user_exists':
                                            $message = 'Username already exists. Please choose another.';
                                            break;
                                        case 'db_error':
                                            $message = 'Database error. Please try again later.';
                                            break;
                                        case 'invalid_csrf':
                                            $message = 'Invalid security token. Please try again.';
                                            break;
                                        default:
                                            $message = 'An error occurred. Please try again.';
                                    }
                                    echo htmlspecialchars($message);
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="/sign_up">
                            <!-- CSRF Token -->
                            <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf_token) ?>">
                            
                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="<?= htmlspecialchars($_GET['username'] ?? '') ?>"
                                       placeholder="Choose a username" required autofocus>
                                <div class="form-text">Your unique username for logging in.</div>
                            </div>
                            
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Create a password" required>
                                <div class="form-text">At least 6 characters recommended.</div>
                            </div>
                            
                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                                       placeholder="Confirm your password" required>
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Sign Up</button>
                        </form>
                    </div>
                    <div class="card-footer bg-white text-center py-3 border-0">
                        <p class="mb-0">Already have an account? <a href="/login" class="text-decoration-none">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>