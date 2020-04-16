<?php
class qst_eval extends dbh
{
 public function qst_evaluation(int $id_qst,string $reponse)
 {
$sql="SELECT * FROM questions WHERE id_quiz=?";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([$id_qst]);
$reponse_juste=$stmt->fetchAll();
if(strcasecmp($reponse_juste[0]['reponse'], $reponse)==0)
{
$results['error']=false;
$results['message']='Excellent!!';
$this->addToLesson($reponse_juste[0]['id_cours']);
$this->addToTheme($reponse_juste[0]['id_cours']);
}
else 
{
$results['error']=true;
$results['message']="Pipiip c'est incorrect!! la reponse juste est :";
$results['correction']=$reponse_juste[0]['reponse'];
}
return $results;
}
public function addToLesson(int $id_cours)
{
$sql="UPDATE cours SET eval_lecon=eval_lecon+1 where id_cours=?";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([$id_cours]);
}
public function addToTheme(int $id_cours)
{
$sql="UPDATE themes SET eval_theme=eval_theme+1 WHERE (id_theme=(SELECT(id_theme)from cours where id_cours=?)";
$stmt=$this->connect()->prepare($sql);
$stmt->execute([$id_cours]);
}
}
?>