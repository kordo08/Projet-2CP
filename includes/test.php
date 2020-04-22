<?php
declare (strict_types = 1);
include 'AutoLoader.inc.php';
?>
<html>
<head></head>
<body>
    <?php
   $objet_eval_niv=new get_qst_niveau();

echo '<pre>';
print_r($objet_eval_niv->getQstniveau(1,1,2));
echo '<pre>';

   ?>
</body>
</html>

