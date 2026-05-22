<?php
require 'config.php';
require 'header.php';
?>
    <h1>Tablet</h1>
    <form method="post">
        <input type="text" name="modello" placeholder="modello">
        <button type="submit">Search</button>
    </form>
    <hr>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $modello=$_POST['modello'];
    $sql = "SELECT * FROM tablet WHERE modello = '$modello'";
    try{
        /** @var $pdo */
        $stm = $pdo->prepare($sql);
        $stm->execute();
        while($row = $stm->fetch()) {
            echo "id: " . $row->id."<br>";
            echo "marca: " . $row->marca."<br>";
            echo "modello: ".$row->modello."<br>";
            echo "colore: ".$row->colore."<br>";
            echo "<hr>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}



