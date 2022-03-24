<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css.css">
</head>
<body>
  <form action="jeu.php" method="get" class="form-example">
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
$db->query("SET NAMES 'utf8'");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

afficherTableauDesScores($db);
?>
