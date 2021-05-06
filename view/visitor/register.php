<h1> Inscription </h1>

<form action="?ctrl=auth&action=register" method="post">

        <input type="email" name="email" id="mail" placeholder="Email" required>

        <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required>

        <input type="password" name="password" id="password" placeholder="Mot de passe" required>

        <input type="password" name="password_repeat" id="password_repeat" placeholder="Validation du mot de passe" required>

        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="submit" name="submit" value="S'INSCRIRE">

</form>