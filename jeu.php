<?php
$db = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', 'Niko250200');
$db->query("SET NAMES 'utf8'");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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


function afficherTableauDesScores($db){
    $requete=$db->prepare("select * from pseudos order by score desc limit 5");
    $requete->execute();
    $tab=$requete->fetchAll(PDO::FETCH_ASSOC);

    echo "<table><th>Pseudo</th><th>Score</th>";
    foreach($tab as $value){
        echo "<tr><td>".$value['pseudo']."</td><td>".$value['score']."</td></tr>";
    }
    echo "</table>";
}

function afficherScore($pseudo, $score){
    echo $pseudo." ton score est ".$score."!!!<br>";
}

entrerScore($db, $pseudo, $score);
afficherScore($pseudo, $score);
afficherTableauDesScores($db);
?>
