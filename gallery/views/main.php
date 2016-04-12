<style>
    body {
        background: url('/img/body-background.jpg');
        background-size:cover;
    }
</style>

<div class="col-lg-6">
    <img style="width:100%" src="/img/logo.jpg" />
</div>

<div class="col-lg-6 login-panel">
    <div class="panel panel-default">
        <div class="panel-heading">
            Sign In
        </div>
        <div class="panel-body" action="/">
            <?php if (isset($error)):?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" />
                </div>

                <div class="form-group">
                    <input type="submit" name="login" class="btn btn-primary form-control" value="Sign In" />
                </div>
                <p class="text-center">
                    <a href="/signup">Sign Up</a>
                </p>
            </form>
        </div>
    </div>
</div>