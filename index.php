<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indice Repository PHP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            margin-top: 0;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        /* Barra di ricerca */
        #searchBar {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }
        #searchBar:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Liste e alberatura */
        ul {
            list-style-type: none;
            padding-left: 20px;
        }
        ul.root-list {
            padding-left: 0;
        }

        li {
            margin: 3px 0;
            user-select: none;
        }

        /* Stile cartelle */
        .caret {
            cursor: pointer;
            font-weight: bold;
            color: #2980b9;
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            transition: background 0.2s;
        }
        .caret:hover {
            background-color: #f0f8ff;
        }
        .caret::before {
            content: "▶";
            color: #7f8c8d;
            display: inline-block;
            margin-right: 8px;
            font-size: 0.7em;
            transition: transform 0.2s;
        }
        .caret-down::before {
            transform: rotate(90deg);
        }

        /* Stile File */
        .file-item {
            padding-left: 30px;
        }
        a.file-link {
            text-decoration: none;
            color: #555;
            transition: color 0.2s;
            display: inline-block;
            padding: 2px 0;
        }
        a.file-link:hover {
            color: #e74c3c;
            text-decoration: underline;
            font-weight: 500;
        }

        /* Gestione Visibilità */
        .nested {
            display: none; /* Chiuse di default */
        }
        .active {
            display: block; /* Aperte */
        }

        /* Classe usata da JS per nascondere elementi durante la ricerca */
        .d-none {
            display: none !important;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📂 Indice Repository PHP</h1>

    <input type="text" id="searchBar" placeholder="🔍 Cerca file o cartelle..." autocomplete="off">

    <div id="treeRoot">
        <?php
        function scansionaDirectory($dir, $isRoot = true) {
            $files = scandir($dir);
            $files = array_diff($files, array('.', '..'));

            // Se non è root, è una nested list
            $ulClass = $isRoot ? "root-list" : "nested";

            echo "<ul class='$ulClass'>";

            foreach ($files as $file) {
                $percorsoReale = $dir . DIRECTORY_SEPARATOR . $file;

                if ($percorsoReale == './index.php') continue;
                if ($file[0] == '.') continue;

                if (is_dir($percorsoReale)) {
                    // CARTELLA
                    echo "<li>";
                    // Aggiungiamo classe searchable-item allo span per trovarlo col JS
                    echo "<span class='caret searchable-item'>" . htmlspecialchars($file) . "</span>";
                    scansionaDirectory($percorsoReale, false);
                    echo "</li>";
                } else {
                    // FILE
                    $linkPath = str_replace('\\', '/', $percorsoReale);
                    echo "<li>";
                    echo "<div class='file-item'>"; // Wrapper div per allineamento
                    // Aggiungiamo classe searchable-item al link
                    echo "<a href='" . $linkPath . "' class='file-link searchable-item' target='_blank'>";
                    echo "📄 " . htmlspecialchars($file);
                    echo "</a>";
                    echo "</div>";
                    echo "</li>";
                }
            }
            echo "</ul>";
        }

        scansionaDirectory('.');
        ?>
    </div>
</div>

<script>
    // 1. GESTIONE CLICK CARTELLE (APRI/CHIUDI)
    var toggler = document.getElementsByClassName("caret");
    for (var i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            var nestedList = this.parentElement.querySelector(".nested");
            if (nestedList) {
                nestedList.classList.toggle("active");
                this.classList.toggle("caret-down");
            }
        });
    }

    // 2. FUNZIONE DI RICERCA CORRETTA
    const searchInput = document.getElementById('searchBar');
    // Prendiamo tutti gli elementi che contengono testo (titoli cartelle e link file)
    const allSearchableItems = document.querySelectorAll('.searchable-item');
    const allListItems = document.querySelectorAll('li');

    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toUpperCase();

        // CASO 1: BARRA DI RICERCA VUOTA
        if (filter === "") {
            // Rimuovi nascondigli
            allListItems.forEach(li => li.classList.remove('d-none'));
            // Richiudi tutte le cartelle (reset stato iniziale)
            document.querySelectorAll('.nested').forEach(ul => ul.classList.remove('active'));
            document.querySelectorAll('.caret').forEach(span => span.classList.remove('caret-down'));
            return;
        }

        // CASO 2: UTENTE STA CERCANDO

        // Passo A: Nascondi TUTTI gli <li> inizialmente
        allListItems.forEach(li => li.classList.add('d-none'));

        // Passo B: Cerca match e rivela
        allSearchableItems.forEach(item => {
            const txtValue = item.textContent || item.innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                // TROVATO!

                // 1. Mostra il <li> che contiene questo elemento
                // item è <a> o <span>. Il suo genitore diretto potrebbe essere <li> o <div class="file-item">
                let currentElement = item.closest('li');
                if (currentElement) {
                    currentElement.classList.remove('d-none');
                }

                // 2. RISALI L'ALBERO (Logica correttiva)
                // Dobbiamo mostrare e aprire tutti i genitori di questo elemento
                let parent = currentElement.parentElement; // Questo è un <ul>

                while (parent) {
                    // Se il genitore è una lista annidata (non la root)
                    if (parent.tagName === 'UL' && parent.classList.contains('nested')) {
                        // 1. Espandi la cartella (display: block)
                        parent.classList.add('active');

                        // 2. Mostra il <li> che contiene questa lista (la cartella padre)
                        let parentLi = parent.parentElement;
                        if (parentLi) {
                            parentLi.classList.remove('d-none');

                            // 3. Ruota la freccina della cartella padre
                            let caret = parentLi.querySelector('.caret');
                            if (caret) caret.classList.add('caret-down');
                        }
                    }
                    // Continua a salire
                    parent = parent.parentElement;
                    // Fermati se arrivi al contenitore principale
                    if (parent.id === 'treeRoot') break;
                }
            }
        });
    });
</script>

</body>
</html>