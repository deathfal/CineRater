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
                    <a href="#">
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
                </div>
            </div>
        </div>
    </nav>

    <?php include $this->view; ?>
</body>

</html>