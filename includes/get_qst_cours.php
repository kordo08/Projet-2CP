<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';

if (isset($_POST))
{
if (!empty($_POST['titre_cours']) && !empty($_POST['titre_theme']) && !empty($_POST['id_user']) && !empty($_POST['num_niveau'])
 && !empty($_POST['nbQstParType']))
 {
$titre_cours=$_POST['titre_cours'];
$titre_theme=$_POST['titre_theme'];
$id_user=(int)$_POST['id_user'];
$num_niveau=(int)$_POST['num_niveau'];
$nbQstParType=(int)$_POST['nbQstParType'];
$objet_qst_cours=new qst_cours();
$tab_qst=$objet_qst_cours->get_qst_all($titre_cours,$titre_theme,$id_user,$num_niveau,$nbQstParType);
}
}
echo json_encode($tab_qst);
?>
