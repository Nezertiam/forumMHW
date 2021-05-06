<img src="https://i.makeagif.com/media/7-31-2016/qDUtPw.gif" alt="">

<h1>Ici s'affichera la liste des signalements</h1>


<?php

$reports = $data["reports"];

?>

<table id="myTableAdmin">
    <thead>
        <tr>
            <th>Date du billet</th>
            <th>Contrevenant</th>
            <th>Message/Sujet</th>
            <th>Raison du report</th>
            <th>Demande émise par</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($reports as $report){?>

            <tr>
                <td><?= $report->getReportDate(true) ?></td>
                <td><?= $report->getReportedUser() ?></td>
                <td><?= $report->getMessage() ? "Sujet : ".$report->getMessage()->getSubject()."<br>".$report->getMessage() : "[Utilisateur signalé depuis son profil]"?></td>
                <td><?= $report->getReportReason() ?></td>
                <td><?= $report->getAskingUser() ?></td>
                <td><a href="?ctrl=admin&action=removeReport&id=<?= $report->getId() ?>">&times;</a></td>
            </tr>

        <?php
        }
        ?>
    </tbody>
</table>