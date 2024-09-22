<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Cine Rater</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- <script src="../../assets/js/functions.js"></script> -->
    <script src="../../assets/js/functions.min.js"></script>    


</head>

<body>

<nav class="navbar">
        <div class="container-fluid">
            <div class="row">

                <div class="col col-5">
                    <a href="/">
                        <img src="../../assets/img/icons/logo.png" alt="Cine Rater Logo">
                    </a>

                    <a href="/">Home</a>
                    <a href="/about">About</a>
                    <a href="#">Contact</a>


                    <div class="col col-12">
                        <input type="text" class="search-bar-input" placeholder="Search movies...">
                    </div>

                </div>

                <div class="col auth-buttons">
                    <?php if (!isset($_SESSION['email'])): ?>
                        <a href="/login">Login</a>
                        <a href="/register">Register</a>
                    <?php else: ?>
                        <a class="admin-btn" href="/admin/dashboard">Dashboard</a>


                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <a class="admin-btn" href="/admin/dashboard">Admin</a>
                        <?php endif; ?>
                        <a href="/logout">Logout</a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>

    <div class="search-results"></div>
    <?php include $this->view; ?>

</body>

</html>