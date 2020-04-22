<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';

if (isset($_POST))
{
if (!empty($_POST['id_user']) && !empty($_POST['num_niveau']) && !empty($_POST['moyenne']) && !empty($_POST['$nb_qsts']) && !empty($_POST['last']))
{
$id_user=(int)$_POST['id_user'];
$num_niveau=(int)$_POST['num_niveau'];
$moyenne=(int)$_POST['moyenne'];
$nb_qsts=(int)$_POST['$nb_qsts'];
$last=(int)$_POST['last'];
$objet_eval_niv=new eval_niveau();
$result=$objet_eval_niv->niveau_evaluation($id_user,$num_niveau,$moyenne,$nb_qsts,$last);
}
}
echo json_encode($result);
?>


