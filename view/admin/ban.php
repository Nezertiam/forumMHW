<?php
    
    $user = $data["user"];

    setlocale(LC_ALL, 'fr_FR.utf8');

?>


<h1>Administration - Pannel bannissement</h1>
<p>
    Analyse de l'éventuel bannissement de l'utilisateur <?= $user ?>
</p>

<?php
if(isset($data["message"])){
$message = $data["message"];
?>
<h2>Intitulé du message signalé :</h2>
<p>
    <p>Date du message : <?= $message->getCreatedAt() ?></p>
    <p>Par : <?= $message->getUser() ?></p>
    <p><?= $message ?></p>
</p>    
<?php } ?>



<h2>Durée de la sentence encourue :</h2>
<form action="?ctrl=admin&action=banUser&id=<?= $user->getId() ?>" method="post">
    <input type="date" name="date" required>
    <input type="text" name="banReason" placeholder="Raison du bannissement" required>

    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <input type="submit" name="submit" value="CONFIRMER">
</form>