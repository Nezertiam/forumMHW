<?php
    
    use App\Core\Session;
    $textPlaceholder = "Pour que les discussions restent agréables, nous vous remercions de rester poli en toutes circonstances. En postant sur nos espaces, vous vous engagez à en respecter la charte d'utilisation. Tout message discriminatorie ou incitant à la haine sera supprimé et son auteur sanctionné.";
    $subject = $data["subject"];
    $messages = $data["messages"];
    setlocale(LC_ALL, 'fr_FR.utf8');
?>


<h3 class="subjecttitle"><?= $subject ?> </h3>
<ul id="subjectnav">
    <a href="#repondre" class="teorange">Répondre</a>
    <a href="?ctrl=home">Liste des sujets</a>
</ul>



<?php

    if(Session::get("user")){
        if($subject->getUser()->getName() == Session::get("user")->getName() || Session::get("user")->hasRole("GRAND_JAGRAS") ){ ?>

            <form action="?ctrl=subject&action=switchlock&id=<?= $subject->getId() ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <?= $subject->getIsLocked() ? "<input type='submit' name='submit' class='uk-button uk-button-primary' value='Rouvrir le sujet'>" : "<input type='submit' name='submit' class='uk-button uk-button-primary' value='Marquer comme Résolu'>"; ?>
            </form>

<?php

        }
    }

?>

<hr>

<section id="messages">
    <?php
    foreach($messages as $message){ ?>

        <div class="post">
            <div class="user">
                <h4><?= $message->getUser() ?></h4>
                <p class="lvl"><?= $message->getUser()->getLevel() ?></p>
                <?= Session::get("user") && Session::get("user")->hasRole("GRAND_JAGRAS") && $message->getUser()->hasRole("GRAND_JAGRAS") ? "<a href='?ctrl=admin&action=goToBanByMessageId&id=".$message->getId()."'>Bannir</a>" : ""; ?>
                <?= Session::get("user") && Session::get('user')->getName() !== $message->getUser()->getName() && !$message->getUser()->hasRole("GRAND_JAGRAS") ? "<a href='?ctrl=report&action=reportMessage&id=".$message->getId()."'>Signaler</a>" : "" ; ?>
            </div>
            <p><?= $message->getCreatedAt() ?></p>
            <br>
            <p class="message"><?= $message ?></p>
        </div>
        <hr>
    <?php
    }
    ?>
</section>



<section id="repondre">

    <h3>Répondre</h3>

    <?php
    if(Session::get("user")){
        if( ! $subject->getIsLocked()){?>

            <form action="?ctrl=subject&action=answerSubject&id=<?= $subject->getId() ?>" method="post">
                <textarea name="text" rows="5" cols="75" placeholder="<?= $textPlaceholder ?>" required></textarea>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <input type="submit" name="submit" class='uk-button uk-button-primary' value="ENVOYER">
            </form>

    <?php
        }
        else{ ?>

        <form action="">
            <textarea name="text" rows="5" cols="75" placeholder="Ce sujet est clos. Il est impossible d'y répondre désormais." required></textarea>
        </form>

    <?php
        }
    }
    else{ ?>

        <form action="">
            <textarea name="text" rows="5" cols="75" placeholder="Vous devez vous connecter pour pouvoir intéragir sur le forum." required></textarea>
        </form>

    <?php
    }
    ?>

</section>