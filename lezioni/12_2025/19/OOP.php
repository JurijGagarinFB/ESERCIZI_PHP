<?php
/**
 * OOP in PHP
 ** Classe e Oggetto
 */
class Studente{
    private string $nome;
    private string $cognome;
    private int $eta;
    private static int $numero = 0;

    public function getNome(): string
    {
        return $this->nome;
    }
    public function getCognome(): string
    {
        return $this->cognome;
    }
    public function getEta(): int
    {
        return $this->eta;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }
    public function setCognome(string $cognome): void
    {
        $this->cognome = $cognome;
    }
    public function setEta(int $eta): void
    {
        $this->eta = $eta;
    }


    public function saluta() : void{
        echo "Ciao sono $this->nome $this->cognome e ho $this->eta anni.";
    }


    public static function presentazione() : void{
        echo "Ciao sono uno studente.";
        self::$numero++;
        echo "Ho presentato ".self::$numero." studenti.";
    }

}

$s = new Studente();
$s->setNome("Mario");
$s->setCognome("Rossi");
$s->setEta(25);

$s->saluta();

echo "<br>";

Studente::presentazione();

echo "<br>";

Studente::presentazione();

echo "<br>";

Studente::presentazione();
#-----------------------------------------------------------------------------------------------------------------------
echo "<br>";
echo "<hr>";
echo "<br>";
#-----------------------------------------------------------------------------------------------------------------------