<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css.css">
</head>
<body>
  <h1>T-rex surfers</h1>
  <div class="jeu"></div>
  <form action="jeu.php" method="get" class="form-example">
    <div class="login">
      <label for="pseudo">Please enter your pseudo: </label>   
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
  $requete=$db->prepare("select * from pseudos order by score desc limit 10");
  $requete->execute();
  $tab=$requete->fetchAll(PDO::FETCH_ASSOC);

  echo "<ul>";
  $i=1;
  foreach($tab as $value){
    if($i == 1){
      echo "<li><div class='couronne'></div><span class='nom'>".$value['pseudo']."</span><span class='score1'>".$value['score']."</sapn></li>";
    }
    else{
      echo "<li>".$i."<span class='nom'>".$value['pseudo']."</span><span class='score'>".$value['score']."</sapn></li>";
    }
    $i+=1;
  }
  echo "</ul>";
}

afficherTableauDesScores($db);
?>
