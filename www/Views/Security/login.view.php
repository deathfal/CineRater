<section class="login-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-12">
                <h1>Login</h1>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col col-3"></div> Empty space for centering -->
            <div class="col col-12">
                <form action="/login" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            <!-- <div class="col col-3"></div> Empty space for centering -->
        </div>
    </div>
</section>
