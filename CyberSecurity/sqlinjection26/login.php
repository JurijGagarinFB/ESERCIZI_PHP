<?php
require 'header.php';
?>
<h1>Login</h1>
    <form action="login_action.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
<?php
require 'footer.php';
?>
