<?php
try
{
    $db = new PDO('mysql:host=sql11.freesqldatabase.com:3306;dbname=sql11481224;charset=utf8', 'sql11481224', 'as7hUUwD7X');
    $db->query("SET NAMES 'utf8'");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "ok";
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$score=100;
$pseudo=$_GET['pseudo'];

function entrerScore($db, $pseudo, $score){
    $requete=$db->prepare("select count(*) as nb from pseudos where pseudo='$pseudo'");
    $requete->execute();
    $tab=$requete->fetch(PDO::FETCH_ASSOC);
    
    if ($tab['nb']==0){
        $requete=$db->prepare("insert into pseudos values ('$pseudo', '$score')");
        echo "new<br>";
    }
    else {
        $requete=$db->prepare("update pseudos set score='$score' where pseudo='$pseudo'");
        echo "old<br>";
    }
    $requete->execute();
}

function afficherScore($pseudo, $score){
    echo $pseudo." ton score est ".$score."!!!<br>";
}

entrerScore($db, $pseudo, $score);
afficherScore($pseudo, $score);
?>
