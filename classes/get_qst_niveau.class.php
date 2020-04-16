<?php
class get_qst_niveau extends dbh 
{
public function getQstniveau(int $id_user,int $num_niveau,int $nbQstParType) 
{
$tab_plaques=$this->getQstd1theme($this->getCoursd1theme($id_user,$num_niveau,'signalisation'),'signalisation',$nbQstParType,$id_user,$num_niveau);
$tab_intersection=$this->getQstd1theme($this->getCoursd1theme($id_user,$num_niveau,'circulation'),'circulation',$nbQstParType,$id_user,$num_niveau);
$tab_divers=$this->getQstd1theme($this->getCoursd1theme($id_user,$num_niveau,'divers'),'divers',$nbQstParType,$id_user,$num_niveau);
$tab_final=array_merge_recursive($tab_plaques,$tab_intersection,$tab_divers);
return $tab_final;
}
public function getCoursd1theme(int $id_user,int $num_niveau,string $titre_theme)
{
$sql="SELECT * FROM cours WHERE  id_theme=(SELECT (id_theme)FROM themes WHERE titre_theme=? AND id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?))";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([$titre_theme,$id_user,$num_niveau]);
$tab=$stmt->fetchAll();
return $tab;
} 
public function getQstd1theme(array $tab_cours,string $titre_theme,int $nbQstParType,int $id_user,int $num_niveau) 
{
$tab_final=array();
foreach($tab_cours as $row)
{
$objet_get_qst_cours=new qst_cours();
$tab_cours=$objet_get_qst_cours->get_qst_all($row['titre_cours'],$titre_theme,$id_user,$num_niveau,$nbQstParType);
$tab_final=array_merge_recursive($tab_final,$tab_cours);
}
return $tab_final;
}
}
?>