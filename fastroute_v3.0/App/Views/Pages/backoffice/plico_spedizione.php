<div class="grid-2">
    <div class="card">
        <h1>Registrazione spedizione</h1>

        <form method="post">
            <label for="codice_plico">Codice plico</label>
            <input type="number" id="codice_plico" name="codice_plico" required>

            <button type="submit">Registra spedizione</button>
        </form>
    </div>

    <div class="card">
        <h2>Plichi in partenza</h2>
        <table>
            <thead>
            <tr>
                <th>Codice</th>
                <th>Stato</th>
                <th>Accettazione</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($inPartenza): ?>
                <?php foreach ($inPartenza as $plico): ?>
                    <tr>
                        <td><?= e($plico->codice_plico) ?></td>
                        <td><?= e($plico->stato) ?></td>
                        <td><?= e($plico->data_ora_accettazione) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nessun plico in partenza.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>