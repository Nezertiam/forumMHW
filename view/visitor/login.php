<h1>Connexion</h1>

<form action="?ctrl=auth&action=login" method="post">
    <input type="email" name="email" id="email" placeholder="Email" required>
    <input type="password" name="password" id="password" placeholder="Mot de passe" required>
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <input type="submit" name="submit" value="CONNEXION">
</form>