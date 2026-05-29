<div class="card">
    <h1>Verifica stato plico</h1>

    <form method="post">
        <label for="codice_plico">Codice plico</label>
        <input type="number" id="codice_plico" name="codice_plico" required>

        <button type="submit">Cerca</button>
    </form>
</div>

<?php if ($risultato): ?>
    <div class="card">
        <h2>Dettaglio plico <?= e($risultato->codice_plico) ?></h2>

        <p><strong>Mittente:</strong> <?= e($risultato->nome_cliente . ' ' . $risultato->cognome_cliente) ?></p>
        <p><strong>Destinatario:</strong> <?= e($risultato->nome_destinatario . ' ' . $risultato->cognome_destinatario) ?></p>
        <p><strong>Sede partenza:</strong> <?= e($risultato->sede_partenza) ?></p>
        <p><strong>Sede arrivo:</strong> <?= e($risultato->sede_arrivo) ?></p>
        <p>
            <strong>Stato:</strong>
            <span class="<?= e(statoBadgeClass($risultato->stato)) ?>">
                <?= e($risultato->stato) ?>
            </span>
        </p>
        <p><strong>Data accettazione:</strong> <?= e($risultato->data_ora_accettazione) ?></p>
        <p><strong>Data spedizione:</strong> <?= e($risultato->data_ora_spedizione ?: '-') ?></p>
        <p><strong>Data ritiro:</strong> <?= e($risultato->data_ora_ritiro ?: '-') ?></p>
    </div>
<?php endif; ?>