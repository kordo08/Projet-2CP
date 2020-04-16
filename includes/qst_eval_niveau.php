<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';

if (!empty($_POST))
{
if (!empty($_POST['id_qst']) && !empty($_POST['reponse']))
{
$id_qst=$_POST['id_qst'];
$reponse=$_POST['reponse'];
$objet_eval_niv=new qst_eval_niveau();
$result=$objet_eval_niv->qst_evaluation($id_qst,$reponse);
}
}
echo json_encode($tab_qst);
?>


