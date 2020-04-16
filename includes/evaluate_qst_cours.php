<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';

if (!empty($_POST))
{
if (!empty($_POST['id_qst']) && !empty($_POST['reponse']))
 {
$id_qst=$_POST['id_qst'];
$reponse=$_POST['reponse'];
$objet_qst_eval=new qst_eval();
$result=$objet_qst_eval->get_qst_all($titre_cours,$titre_theme,$id_user,$num_niveau,$nbQstParType);
}
}
echo json_encode($result);
?>
 