<!DOCTYPE html>
<html>
    <head>
        <title>A blog application</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body>
        <header class="navbar bg-primary ps-5 pe-5">
            <div class="navbar-brand cursor-pointer">
                <a href="/" class="btn">Blog</a>
            </div>
            <div class="navbar-nav">
                <?php if (empty($_SESSION['account_loggedin'])): ?> 
                    <div class="flex">
                        <a href="/login" class="btn btn-secondary">Login</a> 
                        <a href="/signup" class="btn btn-secondary">Sign Up</a>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION['account_loggedin'] ?? false): ?> 
                    <div class="flex">
                        <a href="/post/create" class="btn btn-secondary">New Post</a>
                        <a href="/my_page" class="btn btn-secondary">My Page</a>
                        <a href="/logout" class="btn btn-secondary">Log Out</a> 
                    </div>
                <?php endif; ?>
            </div>
        </header>
        <main>
        <div class="container mt-5">
            <?php include $viewPath ?>
        </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>