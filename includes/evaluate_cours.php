<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';

if (isset($_POST))
{
if (!empty($_POST['id_cours']) && !empty($_POST['moyenne']) && !empty($_POST['last']))
 {
$id_cours=(int)$_POST['id_cours'];
$moyenne=(int)$_POST['moyenne'];
$last=(int)$_POST['last'];
$objet_cours_eval=new eval_cours();
$etat_cours_suivant=$objet_cours_eval->cours_evaluation($id_cours,$moyenne,$last);
}
}
echo json_encode($etat_cours_suivant);
?>
 