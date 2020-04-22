<?php
class eval_cours extends dbh
{
 public function cours_evaluation(int $id_cours,int $moyenne,int $last)
{
$sql="UPDATE cours SET eval_lecon=? where id_cours=?";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([$moyenne,$id_cours]);
if($last==0) 
{
if($moyenne>=4)
{
$id_prochain=$id_cours+1;
$sql="UPDATE cours SET etat_lecon=? where id_cours=?";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([true,$id_prochain]);
$etat_cours_prochain='unblocked';      
}
else
{
$etat_cours_prochain='blocked';    
}
}
else
{
if($moyenne>=4)
{
$etat_cours_prochain='unblocked';
}
else 
{
$etat_cours_prochain='blocked';     
}
}
return $etat_cours_prochain;
}
}
?>
