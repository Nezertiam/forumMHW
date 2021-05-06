<?php
    use App\Core\Session;
    $subjects = $data["subjects"];
    setlocale(LC_ALL, 'fr_FR.utf8');
    $textPlaceholder = "Pour que les discussions restent agréables, nous vous remercions de rester poli en toutes circonstances. En postant sur nos espaces, vous vous engagez à en respecter la charte d'utilisation. Tout message discriminatorie ou incitant à la haine sera supprimé et son auteur sanctionné.";
?>


<h1>Le Forum Francophone n°1 sur  Monster Hunter World !</h1>
<hr>
<h2>Choisis un sujet et commence à échanger avec d'autres chasseurs !</h2>

<a href="#createSubject" class="uk-button uk-button-primary">Créer un nouveau sujet</a>





<table id="myTable">
    <thead>
        <tr>
            <th>SUJET</th>
            <th>AUTEUR</th>
            <th>NB</th>
            <th>DERNIER MESSAGE</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($subjects as $subject){ ?>

        <tr>
            <td><?= $subject ?></td>
            <td><?= $subject->getUser() ?></td>
            <td><?= $subject->getNbMessages() ?></td>
            <td><?= $subject->getLastMessageDate() ?></td>
        </tr>

    <?php
    }
    ?>
    </tbody>

</table>


<hr>


<section id="createSubject">

<h2>Nouveau Sujet</h2>
<?php
if(Session::get("user")){?>

    <form action="?ctrl=subject&action=createSubject" method="post">
        <input type="text" name="title" placeholder="Titre du sujet" id="inputtitle" required><br>
        <textarea name="text" rows="5" placeholder="<?= $textPlaceholder ?>" required></textarea><br>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="submit" name="submit" class="uk-button uk-button-primary" value="ENVOYER">
    </form>

<?php
}
else{ ?>

    <form action="">
        <div id="notConnected">Vous devez vous connecter pour intéragir sur le forum</div>
    </form>

<?php
}
?>

</section>

