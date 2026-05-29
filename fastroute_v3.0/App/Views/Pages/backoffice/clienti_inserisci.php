<div class="grid-2">
    <div class="card">
        <h1>Nuovo cliente</h1>

        <form method="post">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>

            <label for="cognome">Cognome</label>
            <input type="text" id="cognome" name="cognome" required>

            <label for="indirizzo">Indirizzo</label>
            <input type="text" id="indirizzo" name="indirizzo" required>

            <label for="telefono">Telefono</label>
            <input type="text" id="telefono" name="telefono">

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Salva cliente</button>
        </form>
    </div>

    <div class="card">
        <h2>Elenco clienti</h2>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Punti</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($clienti): ?>
                <?php foreach ($clienti as $cliente): ?>
                    <tr>
                        <td><?= e($cliente->id_cliente) ?></td>
                        <td><?= e($cliente->nome . ' ' . $cliente->cognome) ?></td>
                        <td><?= e($cliente->email) ?></td>
                        <td><?= e($cliente->punti_fedelta) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nessun cliente presente.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>