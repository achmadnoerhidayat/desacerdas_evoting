<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">E-voting</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav me-auto mb-2"></div>
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" id="home" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item" id="voting">
                    <a class="nav-link" href="/home/voting.php">E-Voting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/perolehan.php" id="perolehan">Perolehan</a>
                </li>
                <li class="nav-item" v-if="!login">
                    <a class="nav-link" id="login" href="/auth/login.php">Login</a>
                </li>
                <li class="nav-item" v-if="!login">
                    <a class="nav-link" id="register" href="/auth/register.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>