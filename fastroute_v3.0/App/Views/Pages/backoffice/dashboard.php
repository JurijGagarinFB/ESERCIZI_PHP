<div class="card">
    <h1>Dashboard spedizioni</h1>
    <p>Benvenuto, <?= e($_SESSION['utente']['nome']) ?>.</p>
</div>

<div class="card">
    <table>
        <thead>
        <tr>
            <th>Codice</th>
            <th>Mittente</th>
            <th>Destinatario</th>
            <th>Sede partenza</th>
            <th>Sede arrivo</th>
            <th>Stato</th>
            <th>Accettazione</th>
            <th>Spedizione</th>
            <th>Ritiro</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($spedizioni): ?>
            <?php foreach ($spedizioni as $spedizione): ?>
                <tr>
                    <td><?= e($spedizione->codice_plico) ?></td>
                    <td><?= e($spedizione->nome_cliente . ' ' . $spedizione->cognome_cliente) ?></td>
                    <td><?= e($spedizione->nome_destinatario . ' ' . $spedizione->cognome_destinatario) ?></td>
                    <td><?= e($spedizione->sede_partenza) ?></td>
                    <td><?= e($spedizione->sede_arrivo) ?></td>
                    <td>
                        <span class="<?= e(statoBadgeClass($spedizione->stato)) ?>">
                            <?= e($spedizione->stato) ?>
                        </span>
                    </td>
                    <td><?= e($spedizione->data_ora_accettazione) ?></td>
                    <td><?= e($spedizione->data_ora_spedizione ?: '-') ?></td>
                    <td><?= e($spedizione->data_ora_ritiro ?: '-') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">Nessuna spedizione presente.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>