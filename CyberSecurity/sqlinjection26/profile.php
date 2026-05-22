<?php
require 'config.php';
require 'header.php';
?>
<h1>Profile</h1>
<form method="post">
    <input type="text" name="username" placeholder="username">
    <input type="text" name="password" placeholder="password">
    <button type="submit">Search</button>
</form>
    <hr>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    try{
        /** @var $pdo */
        $stm = $pdo->prepare($query);
        $stm->execute();
        while($row = $stm->fetch()) {
            echo "Id: " . $row->id."<br>";
            echo "Username: ".$row->username."<br>";
            echo "Password: ".$row->password."<br>";
            echo "Ruolo: ".$row->role."<br>";
            echo "<hr>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}
