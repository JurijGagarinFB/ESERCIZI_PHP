<div class="card">
    <h1>Accettazione plico</h1>

    <form method="post">
        <label for="codice_plico">Codice plico</label>
        <input type="number" id="codice_plico" name="codice_plico" required>

        <label for="id_cliente">Cliente mittente</label>
        <select id="id_cliente" name="id_cliente" required>
            <option value="">Seleziona cliente</option>
            <?php foreach ($clienti as $cliente): ?> <!--da undefined anche se lo prende (PlicoController accettazione():require once -->
                <option value="<?= e($cliente->id_cliente) ?>">
                    <?= e($cliente->cognome . ' ' . $cliente->nome) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <h3>Dati destinatario</h3>

        <label for="nome_destinatario">Nome</label>
        <input type="text" id="nome_destinatario" name="nome_destinatario" required>

        <label for="cognome_destinatario">Cognome</label>
        <input type="text" id="cognome_destinatario" name="cognome_destinatario" required>

        <label for="indirizzo_destinatario">Indirizzo</label>
        <input type="text" id="indirizzo_destinatario" name="indirizzo_destinatario" required>

        <label for="telefono_destinatario">Telefono</label>
        <input type="text" id="telefono_destinatario" name="telefono_destinatario">

        <label for="email_destinatario">E-mail</label>
        <input type="email" id="email_destinatario" name="email_destinatario">

        <label for="id_sede_partenza">Sede di partenza</label>
        <select id="id_sede_partenza" name="id_sede_partenza" required>
            <option value="">Seleziona sede</option>
            <?php foreach ($sedi as $sede): ?>
                <option value="<?= e($sede->id_sede) ?>">
                    <?= e($sede->nome . ' - ' . $sede->citta) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="id_sede_arrivo">Sede di arrivo</label>
        <select id="id_sede_arrivo" name="id_sede_arrivo" required>
            <option value="">Seleziona sede</option>
            <?php foreach ($sedi as $sede): ?>
                <option value="<?= e($sede->id_sede) ?>">
                    <?= e($sede->nome . ' - ' . $sede->citta) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Registra accettazione</button>
    </form>
</div>