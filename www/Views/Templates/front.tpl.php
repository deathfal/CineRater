<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Cine Rater</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- include js  -->
    <script src="../../assets/js/functions.js"></script>

</head>

<body>
    
<nav class="navbar">
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="#">
                    <img src="../../assets/img/logo.png" alt="Cine Rater Logo">
                </a>
            </div>
            <div class="col">
                <input type="text" placeholder="Search...">
            </div>
            <div class="col">
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </div>
</nav>

    <?php include $this->view; ?>
</body>

</html>
