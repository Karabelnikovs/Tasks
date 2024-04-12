<?php require "components/head.php" ?>

<div class="content">
    <br>
    <h1>Login</h1>
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email"
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control">
        <br>
        <button class="btn btn-primary">Log in</button>
    </form>
    <br><br>
    <p><a href="signup" class="btn btn-outline-success">Sign up</a></p>
</div>
</body>

</html>