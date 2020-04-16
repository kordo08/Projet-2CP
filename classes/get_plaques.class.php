<?php
class get_plaques extends dbh
{
    public function getPlaques(string $titre_cours)
    {
    $sql="SELECT * FROM plaques WHERE titre_cours=?";
    $stmt=$this->connect()->prepare($sql);
    $stmt->execute([$titre_cours]);
    $tab_plaques=$stmt->fetchAll();
    return $tab_plaques;
    }
}
?>