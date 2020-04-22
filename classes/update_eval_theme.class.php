<?php
class update_eval_theme extends dbh 
{
public function update_theme(int $id_user,int $num_niveau,string $titre_theme,int $last)
{
$sql="UPDATE themes SET eval_theme=? where id_theme=(SELECT (id_theme)FROM themes WHERE titre_theme=? AND id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?))";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([3,$titre_theme,$id_user,$num_niveau]);
if($last==0)
{
$sql="UPDATE themes SET etat_theme=? where id_theme=(SELECT (id_theme)FROM themes WHERE titre_theme=? AND id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?))+1";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([true,$titre_theme,$id_user,$num_niveau]);
}
}
}



?>