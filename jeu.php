<?php

$db = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', 'Niko250200');
$db->query("SET NAMES 'utf8'");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$score=10;
$pseudo=$_GET['pseudo'];
$requete=$db->prepare("select count(*) as nb from pseudos where pseudo='$pseudo'");
$requete->execute();
$tab=$requete->fetch(PDO::FETCH_ASSOC);

if ($tab['nb']==0){
    $requete=$db->prepare("insert into pseudos values ('$pseudo', '$score')");
    echo "new";
}
else {
    $requete=$db->prepare("update pseudos set score='$score' where pseudo='$pseudo'");
    echo "old";
}
$requete->execute();
?>

