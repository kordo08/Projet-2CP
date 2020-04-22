<?php
class qst_cours extends dbh
{
public function get_qst_all(string $titre_cours,string $titre_theme,int $id_user,int $num_niveau,int $nbQstParType)
{
$tab_VF=$this->get_qst('vrai/faux',$titre_cours,$titre_theme,$id_user,$num_niveau);
$tab_multi=$this->get_qst('multi',$titre_cours,$titre_theme,$id_user,$num_niveau);
$tab_final=$this->table_final($tab_VF,$tab_multi,$nbQstParType,$titre_theme,$titre_cours);
return $tab_final;
}
public function get_qst(string $type_quiz,string $titre_cours,string $titre_theme,int $id_user,int $num_niveau)
{
$sql="SELECT * FROM questions WHERE type_quiz=? AND id_cours= (SELECT (id_cours) FROM cours WHERE titre_cours =? AND id_theme=(SELECT (id_theme)FROM themes WHERE titre_theme=? AND id_niveau=(SELECT(id_niveau) FROM niveaux WHERE id_user=? AND num_niveau=?)))";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([$type_quiz,$titre_cours,$titre_theme,$id_user,$num_niveau]);
$tab=$stmt->fetchAll();
return $tab;
}
public function table_final(array $tab1,array $tab2,int $nbQstParType,string $titre_theme,string $titre_cours)
{
    $max1=count($tab1)-1;
    $max2=count($tab2)-1;
    $i=0;
    $tableau1 = array();
    $tableau2 = array();
    $tabQst=array();
    while ($i<$nbQstParType)
    {
        $indice = rand(0, $max1);
        if (!in_array($indice, $tableau1)) {
            $tableau1[] = $indice;
            $tabQst[$i]=$tab1[$indice]; 
            $tabQst[$i]['choix_1']=NULL; 
            $tabQst[$i]['choix_2']=NULL;     
                $i++;
        }
    }
   
    while ($i<2*$nbQstParType)
    {
        $indice = rand(0, $max2);
        if (!in_array($indice, $tableau2)) {
            $tableau2[] = $indice;
            $tabQst[$i]=$tab2[$indice];
            $tab_choix=$this->get_choices($titre_theme,$titre_cours,$tab2[$indice]['reponse']);
            if((strcasecmp($titre_theme,'circulation')==0) && strlen($tab2[$indice]['reponse'])==3)
            {
            $tabQst[$i]['choix_1']=$tab_choix[0];
            $tabQst[$i]['choix_2']=NULL;   
            }
           else
           {
            $tabQst[$i]['choix_1']=$tab_choix[0];
            $tabQst[$i]['choix_2']=$tab_choix[1]; 
           }       
                $i++;
           
        }
    }
    $tableau_final=array_merge_recursive($tableau1,$tableau2);
    
    return $tabQst;

}
public function get_choices(string $titre_theme,string $titre_cours,string $reponse_juste)
{
 if (strcasecmp($titre_theme,'signalisation')==0)
 {
    $sql="SELECT * FROM plaques WHERE nom_plaque !=? AND titre_cours=?";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([$reponse_juste,$titre_cours]);
    $tab=$stmt->fetchAll();   
 } 
 if(strcasecmp($titre_theme,'circulation')==0)
 {
    $sql="SELECT * FROM choix_intersections WHERE choix !=? AND nb_pos=?";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([$reponse_juste,strlen($reponse_juste)]);
    $tab=$stmt->fetchAll();
 }
 if(strcasecmp($titre_theme,'divers')==0)
 {
    $sql="SELECT * FROM choix_divers WHERE choix !=? AND titre_cours=?";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([$reponse_juste,$titre_cours]);
    $tab=$stmt->fetchAll(); 
    
 }
 $max=count($tab)-1;
 $i=0;
 $tableau = array();
 $tabChoix= array();
 if((strcasecmp($titre_theme,'circulation')==0) && strlen($reponse_juste)==3)
 {
    $tabChoix[]=$tab[0]['choix'];
 }
 else
 {
 while ($i<2)
 {
     $indice = rand(0, $max);
     if (!in_array($indice, $tableau)) {
         $tableau[] = $indice;
         if (strcasecmp($titre_theme,'signalisation')==0)
         {$tabChoix[$i]=$tab[$indice]['nom_plaque'];}
         else
         {$tabChoix[$i]=$tab[$indice]['choix'];}          
             $i++;
     }
 }
}
 return $tabChoix;
}
}
?>