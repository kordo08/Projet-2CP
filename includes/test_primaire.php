<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';

if (isset($_POST))
{
if (!empty($_POST['id_user']) && !empty($_POST['num_niveau'])&& !empty($_POST['nbQstParType']))
{
    $id_user=(int)$_POST['id_user'];
    $nbQstParType=(int)$_POST['nbQstParType'];
    $objet_test_primaire=new test_primaire();
    $tab_qst=$objet_test_primaire->test_primaire_qsts($id_user,$nbQstParType);
}
}
echo json_encode($tab_qst);
?>