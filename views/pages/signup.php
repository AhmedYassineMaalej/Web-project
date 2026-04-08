<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PickPocket | Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b, #3b82f6);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.85) !important;
        }

        .stickers-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .sticker {
            position: absolute;
            font-size: 30px;
            opacity: 0.8;
            animation: floatRandom linear infinite;
        }
        .sticker:nth-child(1)  { left: 5%;  top: 80%; animation-duration: 12s; }
        .sticker:nth-child(2)  { left: 15%; top: 60%; animation-duration: 18s; font-size: 40px; }
        .sticker:nth-child(3)  { left: 25%; top: 90%; animation-duration: 14s; }
        .sticker:nth-child(4)  { left: 35%; top: 70%; animation-duration: 20s; font-size: 45px; }
        .sticker:nth-child(5)  { left: 45%; top: 85%; animation-duration: 16s; }
        .sticker:nth-child(6)  { left: 55%; top: 75%; animation-duration: 22s; }
        .sticker:nth-child(7)  { left: 65%; top: 95%; animation-duration: 17s; font-size: 38px; }
        .sticker:nth-child(8)  { left: 75%; top: 65%; animation-duration: 19s; }
        .sticker:nth-child(9)  { left: 85%; top: 88%; animation-duration: 15s; }
        .sticker:nth-child(10) { left: 10%; top: 95%; animation-duration: 21s; }
        .sticker:nth-child(11) { left: 50%; top: 92%; animation-duration: 18s; }
        .sticker:nth-child(12) { left: 90%; top: 85%; animation-duration: 23s; font-size: 42px; }

        @keyframes floatRandom {
            0% {
                transform: translateY(0px) translateX(0px);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            50% {
                transform: translateY(-300px) translateX(20px);
            }
            100% {
                transform: translateY(-700px) translateX(-20px);
                opacity: 0;
            }
        }

        .signup-card {
            position: relative;
            z-index: 2;
            border-radius: 20px;
            backdrop-filter: blur(15px);
            background: rgba(255,255,255,0.95);
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
            transition: transform 0.3s ease;
        }

        .signup-card:hover {
            transform: translateY(-5px);
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #ddd;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }
        .btn-primary {
            border-radius: 12px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(59,130,246,0.4);
        }

        .title {
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
<!-- stickers -->
<div class="stickers-container">
    <div class="sticker">🪙</div>
    <div class="sticker">💰</div>
    <div class="sticker">💵</div>
    <div class="sticker">🪙</div>
    <div class="sticker">💸</div>
    <div class="sticker">🪙</div>
    <div class="sticker">💰</div>
    <div class="sticker">💵</div>
    <div class="sticker">🪙</div>
    <div class="sticker">💸</div>
    <div class="sticker">🪙</div>
    <div class="sticker">💰</div>
</div>

<!-- nav -->
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/">
            <img src="https://staging.svgrepo.com/show/15477/coin.svg" width="40">
            PickPocket
        </a>
        <div class="ms-auto">
            <a class="nav-link fw-semibold" href="/login">Login</a>
        </div>
    </div>
</nav>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: relative; z-index: 2; max-width: 600px; margin: 20px auto;">
        <strong>⚠️ Error!</strong> <?php echo htmlspecialchars($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="col-md-6 col-lg-5">

        <div class="signup-card p-4">

            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary title">Create Account</h2>
                <p class="text-muted">Join PickPocket and hunt the best deals 💰</p>
            </div>

            <!-- error -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?php 
                        $error = $_GET['error'];
                        $message = '';
                        switch($error) {
                            case 'empty_fields': $message = 'Please fill in all fields.'; break;
                            case 'password_mismatch': $message = 'Passwords do not match.'; break;
                            case 'user_exists': $message = 'Username already exists.'; break;
                            case 'db_error': $message = 'Database error.'; break;
                            case 'invalid_csrf': $message = 'Invalid security token.'; break;
                            default: $message = 'Something went wrong.';
                        }
                        echo htmlspecialchars($message);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- form -->
            <form method="POST" action="/sign_up">

                <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf_token) ?>">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Username</label>
                    <input type="text" class="form-control"
                        name="username"
                        value="<?= htmlspecialchars($_GET['username'] ?? '') ?>"
                        placeholder="type your username"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control"
                        name="password"
                        placeholder="password"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" class="form-control"
                        name="confirm_password"
                        placeholder="confirm your password"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    Create Account
                </button>

            </form>

            <div class="text-center mt-4">
                <p class="mb-0 text-muted">
                    Already have an account?
                    <a href="/login" class="fw-semibold text-decoration-none">Login</a>
                </p>
            </div>

        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
