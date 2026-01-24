<?php include('navbar.php'); ?>


<header class="inscription-header">
    <h1>Inscription</h1>
</header>

<main>
    <form method="post">
        <label>Login</label>
        <input type="text" name="login" required>

        <label>Mot de passe</label>
        <input type="password" name="password" required>

        <label>Confirmer le mot de passe</label>
        <input type="password" name="confirm_password" required>

        <input type="submit" name="submit" value="S'inscrire">
    </form>
</main>
