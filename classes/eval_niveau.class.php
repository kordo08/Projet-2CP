<?php 
class eval_niveau extends dbh
{
public function niveau_evaluation(int $id_user,int $num_niveau,int $moyenne,int $nb_qsts,int $last)
 {
     if($moyenne<=(0.5*$nb_qsts))  
 {
    $result['etat_niv_prochain']='blocked';
    if($moyenne<=(0.25*$nb_qsts))
    {
    $sql="UPDATE niveaux SET eval_niv=? where id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?)";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([0,$id_user,$num_niveau]);
    $result['eval_niv_courant']='unblocked'; 
    }
    if($moyenne>(0.25*$nb_qsts) && $moyenne<=(0.5*$nb_qsts))
    {
    $sql="UPDATE niveaux SET eval_niv=? where id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?)";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([1,$id_user,$num_niveau]); 
    $result['eval_niv_courant']='onestar'; 
    }
}
if($moyenne>(0.5*$nb_qsts))

{   if($last==0)
    {
    $sql="UPDATE niveaux SET etat_niveau=? where id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?)+1";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([true,$id_user,$num_niveau]);
    }
    $result['etat_niv_prochain']='unblocked';
    if($moyenne>(0.5*$nb_qsts) && $moyenne<=(0.75*$nb_qsts))
    {
    $sql="UPDATE niveaux SET eval_niv=? where id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?)";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([2,$id_user,$num_niveau]);
    $result['eval_niv_courant']='twostars'; 
    }
    if($moyenne>(0.75*$nb_qsts))
    {
    $sql="UPDATE niveaux SET eval_niv=? where id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?)";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([3,$id_user,$num_niveau]); 
    $result['eval_niv_courant']='threestars'; 
    }
 }
 return $result;
 }
 }
?>
