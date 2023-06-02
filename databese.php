<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
</head>
<body>
<?php
$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "Connectie gemaakt!";
} 
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<!DOCTYPE html>
<html>
<head>
 <title>Product Toevoegen</title>
</head>
<body>
 <h2>Voeg een nieuw product toe:</h2>
 <form method="POST" action="insert.php">
 <label for="product_naam">Productnaam:</label>
 <input type="text" name="product_naam" id="product_naam" required><br><br>
 <input type="number" step="0.01" name="prijs_per_stuk" id="prijs_per_stuk" required><br><br>
 <label for="prijs_per_stuk">Prijs per stuk:</label>
 <label for="omschrijving">Omschrijving:</label>
 <textarea name="omschrijving" id="omschrijving" required></textarea><br><br>
<input type="submit" value="Product toevoegen">

</form>

</body>

</html>
<?php



 if(isset($_POST["verzenden"])) {

 $product_naam= $_POST['product_naam'];

 $prijs_per_stuk=$_POST['prijs_per_stuk'];

$omschrijving=$_POST['omschrijving'];


$data = [
'product_naam' => $product_naam,
'prijs_per_stuk' => $prijs_per_stuk,
'omschrijving' => $omschrijving,
];

$sql = "INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) '
VALUES (:product_naam, :prijs_per_stuk, :omschrijving)";
$stmt=$pdo->prepare($sql);
$stmt->execute($data);

 }

?>