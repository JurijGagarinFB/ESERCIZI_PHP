<?php
require "header.php";
?>
<p>Ciao <?=$_SESSION['username']?> inserisci la nuova password</p>
<form action="cambiopwd_action.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="password" placeholder="Password">
        <button type="submit">Cambio</button>
</form>
