<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Cine Rater</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../../assets/js/functions.js"></script>

</head>

<body>

    <nav class="navbar">
        <div class="container-fluid">
            <div class="row">

                <div class="col col-6">
                    <a href="/">
                        <img src="../../assets/img/icons/logo.png" alt="Cine Rater Logo">
                    </a>

                    <input type="text" placeholder="Search">

                    <a href="/">Home</a>
                    <a href="#">About</a>
                    <a href="#">Contact</a>
                </div>

                <div class="col auth-buttons">
                    <?php if (!isset($_SESSION['email'])): ?>
                        <a href="/login">Login</a>
                        <a href="/register">Register</a>
                    <?php else: ?>
                        <a href="/dashboard">Dashboard</a>
                        <a href="/logout">Logout</a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="/admin/dashboard">Admin</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <?php include $this->view; ?>

    <footer class="footer">
    <div class="container-fluid">
        <div class="col col-12 col-md-4">
            <img src="../../assets/img/icons/logo.png" alt="Cine Rater Logo" class="footer-logo">
            <p>Welcome to Cine Rater, where you can rate and discover your favorite movies!</p>
        </div>


        <div class="col col-12 col-md-4">
            <ul class="social-links">
                <li><a href="#"><img src="../../assets/img/icons/facebook.png" alt="Facebook"></a></li>
                <li><a href="#"><img src="../../assets/img/icons/twitter.png" alt="Twitter"></a></li>
                <li><a href="#"><img src="../../assets/img/icons/instagram.png" alt="Instagram"></a></li>
                <li><a href="#"><img src="../../assets/img/icons/youtube.png" alt="YouTube"></a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col col-12">
            <p>&copy; <?= date("Y") ?> Cine Rater. All Rights Reserved.</p>
        </div>
    </div>
</footer>


</body>

</html>