<?php
class eval_theme extends dbh 
{
public function theme_evaluation(int $id_user,int $num_niveau,string $titre_theme,int $last)
{
$tab_cours=$this->getCoursd1theme($id_user,$num_niveau,$titre_theme);
$moyenne_theme=0;
foreach($tab_cours as $row)
{
$moyenne_theme=$moyenne_theme+$row['eval_lecon'];
}
if($moyenne_theme==6*count($tab_cours))
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
$result['eval_theme_courant']='threestars';
$result['etat_theme_prochain']='unblocked';

}
else
{
$result['eval_theme_courant']='unblocked';
$result['etat_theme_prochain']='blocked';
}
return $result;
}
public function getCoursd1theme(int $id_user,int $num_niveau,string $titre_theme)
{
$sql="SELECT * FROM cours WHERE  id_theme=(SELECT (id_theme)FROM themes WHERE titre_theme=? AND id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?))";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([$titre_theme,$id_user,$num_niveau]);
$tab=$stmt->fetchAll();
return $tab;
} 
}
?>
