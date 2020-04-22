<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';

if (isset($_POST))
{
if (!empty($_POST['id_user']) && !empty($_POST['num_niveau'])&& !empty($_POST['titre_theme']) && !empty($_POST['last']))
{
$id_user=(int)$_POST['id_user'];
$num_niveau=(int)$_POST['num_niveau'];
$titre_theme=$_POST['titre_theme'];
$last=(int)$_POST['last'];
$objet_eval_theme=new eval_theme();
$result=$objet_eval_theme->theme_evaluation($id_user,$num_niveau,$titre_theme,$last);
}
}
echo json_encode($result);
?>

