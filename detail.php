<?php
$id= $_GET["id"];
include_once("database.php");
$sth = $conn->prepare('SELECT * FROM products
    WHERE id = ?');
$sth->bindValue(1, $id);
$sth->execute();
$result= $sth->fetch();

// echo $result[0]."<br>";
// echo $result[1]."<br>";
// echo $result[2]."<br>";
// echo $result[3];
$url = "order.php?id=".$result[0];
?>
<?
$files = glob($result[4]."/*.*");

$id=$result['0'];
// print_r($files);
$url= "detail.php?id=".$id?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="detail.css">
</head>
<body>
    <div class="container">
        
        <?
    for ($i=0; $i<count($files); $i++)

{

$image = $files[$i];?>
<div class="image">
<img src="<?echo $image ?>" alt="Gallery #1" width  />
</div>

<?

}

?>
</div>
<div class="detailbox">
<div class="details">
<h1>Product:<?echo $result[1]?></h1>
<h2>Cost Price:<?echo $result[2]?></h2>
<h2>Cost Price:<?echo $result[3]?></h2>
<button onclick="window.location.href='<?echo "order.php?id=".$result[0] ?>'">BUY NOW</button>
</div>
</div>
</body>
</html>
