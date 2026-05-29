<div class="card">
    <h1>Personalizzazione tema</h1>
    <p>Scegli un colore di sfondo per la tua area personale.</p>

    <form method="post">
        <label for="colore_sfondo">Colore di background</label>
        <input type="color" id="colore_sfondo" name="colore_sfondo"
               value="<?= e($_SESSION['utente']['colore_sfondo'] ?? '#f5f5f5') ?>">

        <button type="submit">Salva preferenza</button>
    </form>
</div>