<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css.css">
</head>
<body>
  <div class="container">
    <table>
      <thead>
        <tr>
           <th>Pseudo</th>
           <th >score</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Jeanne</td>
          <td>Biche</td>
        </tr>
      </tbody>
    </table>
    <br>
    <br>
    <form action="jeu.php" method="get" class="form-example">
        <div class="login">
          <label for="pseudo">Enter your pseudo: </label>   
          <input type="text" name="pseudo" id="pseudo" required>
        </div>
    </form>
  </div>
</body>
</html>
<?php
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

afficherTableauDesScores($db);
?>
