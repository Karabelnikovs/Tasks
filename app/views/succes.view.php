<?php require "components/head.php" ?>
<script>
    function redirectAfterSeconds() {
        setTimeout(function () {
            window.location.href = "/";
        }, 5000);
    }
</script>
<div class="content">
    <h1>Succes!</h1>
    <br>
    <p>Redirecting to login in 5 seconds, or press <a href="/" class="btn btn-primary">here</a> if it doesn't redirect
    </p>
    <script>redirectAfterSeconds();</script>

</div>
</body>

</html>