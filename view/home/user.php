<?php 

use App\Core\Session;

$user = $data["user"] 


?>

<h1><?= $user->getName() ?></h1>
<?= Session::get("user") && Session::get("user")->hasRole("GRAND_JAGRAS") && !$user->hasRole("GRAND_JAGRAS") ? "<a href='?ctrl=admin&action=goToBanByUserId&id=".$user->getId()."'>Bannir</a>" : "" ?><br>
<?= Session::get("user") && Session::get('user')->getName() !== $user->getName() && !$user->hasRole("GRAND_JAGRAS") ? "<a href='?ctrl=report&action=reportUser&id=".$user->getId()."'>Signaler</a>" : "" ; ?>

<h3>Nombre de messages : <?= $user->getNbPosts() == null ? 0 : $user->getNbPosts() ?></h3>