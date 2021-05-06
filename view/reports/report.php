<?php
    
    $reportedUser = $data["reportedUser"];

    setlocale(LC_ALL, 'fr_FR.utf8');

?>


<h1>Signaler un utilisateur</h1>
<p>
    Vous allez amorcer une demande de modération envers l'utilisateur <?= $reportedUser ?>
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

    <h2>Pour quelle raison ?</h2>
    <form action="?ctrl=report&action=reportMessage&id=<?= $message->getId() ?>" method="post">
        <input type="text" name="reportReason" placeholder="Raison du signalement" required>

        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="submit" name="submit" value="CONFIRMER">
    </form>
<?php }
else{ ?>
    <h2>Pour quelle raison ?</h2>
    <form action="?ctrl=report&action=reportUser&id=<?= $reportedUser->getId() ?>" method="post">
        <input type="text" name="reportReason" placeholder="Raison du signalement" required>

        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="submit" name="submit" value="CONFIRMER">
    </form>
<?php }?>



