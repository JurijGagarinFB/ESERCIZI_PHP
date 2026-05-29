<div class="card">
    <h1>Cambia password</h1>
    <p class="small">
        La nuova password deve contenere almeno 8 caratteri, una maiuscola,
        una minuscola, un numero e un carattere speciale.
    </p>

    <form method="post">
        <label for="nuova_password">Nuova password</label>
        <input type="password" id="nuova_password" name="nuova_password" required>

        <label for="conferma_password">Conferma password</label>
        <input type="password" id="conferma_password" name="conferma_password" required>

        <button type="submit">Salva password</button>
    </form>
</div>