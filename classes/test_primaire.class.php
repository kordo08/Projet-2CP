<?php
class test_primaire extends dbh 
{
public function test_primaire_qsts(int $id_user,int $nbQstParType) 
{
$objet_eval_niv1=new get_qst_niveau();
$objet_eval_niv2=new get_qst_niveau();
$objet_eval_niv3=new get_qst_niveau();
$tab_N1=$objet_eval_niv1->getQstniveau($id_user,1,$nbQstParType);
$tab_N2=$objet_eval_niv2->getQstniveau($id_user,2,$nbQstParType);
$tab_N3=$objet_eval_niv2->getQstniveau($id_user,3,$nbQstParType);
$tab_final=array_merge_recursive($tab_N1,$tab_N2,$tab_N3);
return $tab_final;
}
}
?>