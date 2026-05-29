<div class="card">
    <h1>Statistiche</h1>

    <form method="get">
        <label for="giorni">Numero di giorni</label>
        <input type="number" id="giorni" name="giorni" min="1" value="<?= e($giorni) ?>">
        <button type="submit">Calcola</button>
    </form>
</div>

<div class="card">
    <h2>Plichi ritirati negli ultimi <?= e($giorni) ?> giorni</h2>
    <p><strong>Totale:</strong> <?= e($totale) ?></p>
</div>

<div class="card">
    <table>
        <thead>
        <tr>
            <th>Codice plico</th>
            <th>Data ritiro</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($ritirati): ?>
            <?php foreach ($ritirati as $riga): ?>
                <tr>
                    <td><?= e($riga->codice_plico) ?></td>
                    <td><?= e($riga->data_ora_ritiro) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">Nessun plico ritirato nel periodo selezionato.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>