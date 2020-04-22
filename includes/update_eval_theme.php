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
$objet_update_theme=new update_eval_theme();
$objet_update_theme->update_theme($id_user,$num_niveau,$titre_theme,$last);
}
}

?>
