<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';

if (isset($_POST))
{
if (!empty($_POST['titre_cours']))
 {
$titre_cours=$_POST['titre_cours'];
$objet_get_plaques=new get_plaques();
$tab_plaques=$objet_get_plaques->getPlaques($titre_cours);
}
}
echo json_encode($tab_plaques);
?>
