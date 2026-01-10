<?php
/**
 * PHP-2
 *
 * Prima parte:
 *
 * Progettare una struttura dati con le seguenti tre caratteristiche:
 * - Deve contenere le discipline INFORMATICA, SISTEMI, e TPS.
 * - A ciascuna disciplina devono essere associati uno o più percorsi nel file system (ad esempio: C:\Utenti\Bob\Documenti);
 * - Ogni percorso deve contenere il nome di un argomento (ad esempio: Socket per la materia TPS) e il mese dell'anno in formato numerico in cui l'argomento è stato (o sarà) trattato.
 *
 * Seconda parte:
 ** 1- Creare una funzione che consenta di estrarre dalla struttura dati il nome dell'argomento e il mese di studio, partendo dalla materia e dal percorso specificato.
 ** 2- Creare una funzione che possa inserire, per qualunque delle tre discipline, tutti gli altri dati come indicati sopra; questa funzione deve:
 ** a)controllare che la disciplina che si vuole inserire sia tra le tre permesse;
 ** b)evitare di sovrascrivere un percorso già esistente nella stessa disciplina;
 ** c)controllare che il mese sia compreso nell'intervallo 1 - 12.
 *
 * P.S. per PHP-2 creare prima la struttura dati e popolarla con dei dati a piacere(Prima parte); proseguire quindi con l'implementazione delle funzioni (Seconda parte).
 */

$discipline = [
    "INFORMATICA" => [
        "directory" => DIRECTORY_SEPARATOR . "INFORMATICA.txt",
        "mesi" => [
            "1" => [
                "argomenti" => [
                    "Ripasso in itinere"
                ]
            ],
            "2" => [
                "argomenti" => [

                ]
            ],
            "3" => [
                "argomenti" => [

                ]
            ],
            "4" => [
                "argomenti" => [

                ]
            ],
            "5" => [
                "argomenti" => [

                ]
            ],
            "6" => [
                "argomenti" => [

                ]
            ],
            "7" => [
                "argomenti" => [

                ]
            ],
            "8" => [
                "argomenti" => [

                ]
            ],
            "9" => [
                "argomenti" => [
                    "Ripasso Frontend",
                    "DBMS"
                ]
            ],
            "10" => [
                "argomenti" => [
                    "DBMS",
                    "SQL"
                ]
            ],
            "11" => [
                "argomenti" => [
                    "SQL",
                    "Schemi E-R",
                    "PHP"
                ]
            ],
            "12" => [
                "argomenti" => [
                    "Schemi E-R",
                    "PHP"
                ]
            ],
        ],
    ],
    "SISTEMI" => [
        "directory" => DIRECTORY_SEPARATOR . "SISTEMI.txt",
        "mesi" => [
            "1" => [
                "argomenti" => [

                ]
            ],
            "2" => [
                "argomenti" => [

                ]
            ],
            "3" => [
                "argomenti" => [

                ]
            ],
            "4" => [
                "argomenti" => [

                ]
            ],
            "5" => [
                "argomenti" => [

                ]
            ],
            "6" => [
                "argomenti" => [

                ]
            ],
            "7" => [
                "argomenti" => [

                ]
            ],
            "8" => [
                "argomenti" => [

                ]
            ],
            "9" => [
                "argomenti" => [

                ]
            ],
            "10" => [
                "argomenti" => [

                ]
            ],
            "11" => [
                "argomenti" => [

                ]
            ],
            "12" => [
                "argomenti" => [

                ]
            ],
        ],
    ],
    "TPS" => [
        "directory" => DIRECTORY_SEPARATOR . "TPS.txt",
        "mesi" => [
            "1" => [
                "argomenti" => [

                ]
            ],
            "2" => [
                "argomenti" => [

                ]
            ],
            "3" => [
                "argomenti" => [

                ]
            ],
            "4" => [
                "argomenti" => [

                ]
            ],
            "5" => [
                "argomenti" => [

                ]
            ],
            "6" => [
                "argomenti" => [

                ]
            ],
            "7" => [
                "argomenti" => [

                ]
            ],
            "8" => [
                "argomenti" => [

                ]
            ],
            "9" => [
                "argomenti" => [

                ]
            ],
            "10" => [
                "argomenti" => [

                ]
            ],
            "11" => [
                "argomenti" => [

                ]
            ],
            "12" => [
                "argomenti" => [

                ]
            ],
        ],
    ]
];

$handle_informatica = fopen($discipline["INFORMATICA"]["directory"], "w");
$handle_sistemi = fopen($discipline["SISTEMI"]["directory"], "w");
$handle_TPS = fopen($discipline["TPS"]["directory"], "w");


#-----------------------------------------------------------------------------------------------------------------------
echo "<br>";
echo "<hr>";
echo "<br>";
#-----------------------------------------------------------------------------------------------------------------------

