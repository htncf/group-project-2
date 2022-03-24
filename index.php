<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css.css">
</head>
<body>
  <form method="post" class="form-example">
    <div class="login">
      <label for="pseudo">Enter your pseudo: </label>   
      <input type="text" name="pseudo" id="pseudo" required>
    </div>
  </form>
</body>
</html>
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

$score=2000;
if (isset($_POST['pseudo']) && strlen($_POST['pseudo'])<=20){
  $pseudo=$_POST['pseudo'];
  entrerScore($db, $pseudo, $score);
  afficherScore($pseudo, $score);
}
elseif (isset($_POST['pseudo']) && strlen($_POST['pseudo'])>20){
  echo "<script>alert(\"Le pseudo doit faire 20 caractères maximum\")</script>";
}

function afficherTableauDesScores($db){
  $requete=$db->prepare("select * from pseudos order by score desc limit 5");
  $requete->execute();
  $tab=$requete->fetchAll(PDO::FETCH_ASSOC);

  echo '<div class="container">';
  echo "<table><th>Pseudo</th><th>Score</th>";
  foreach($tab as $value){
    echo "<tr><td>".$value['pseudo']."</td><td>".$value['score']."</td></tr>";
  }
  echo "</table>";
  echo "</div>";
}

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

afficherTableauDesScores($db);
?>
