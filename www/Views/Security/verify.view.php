<section class="verify-section">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col col-12">
                <h1>Account Verification</h1>
                <p><?= $message; ?></p>
                <?php if (strpos($message, 'activated') !== false): ?>
                    <a href="/login" class="btn btn-primary">Login Now</a>
                <?php else: ?>
                    <a href="/register" class="btn btn-primary">Try Registering Again</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
