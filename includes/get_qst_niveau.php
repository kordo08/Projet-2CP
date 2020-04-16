<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';

if (!empty($_POST))
{
if (!empty($_POST['id_user']) && !empty($_POST['num_niveau'])&& !empty($_POST['nbQstParType']))
{
$id_user=$_POST['id_user'];
$num_niveau=$_POST['num_niveau'];
$nbQstParType=$_POST['nbQstParType'];
$objet_qst=new get_qst_niveau();
$tab_qst=$objet_qst->getQstniveau($id_user,$num_niveau,$nbQstParType);
}
}
echo json_encode($tab_qst);
?>

