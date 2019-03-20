<?php
include_once("database.php");
$sql="SELECT * FROM products";
$query=$conn->query($sql);
$number_of_results= $query->rowcount();
$results_per_page=2;
$number_of_pages = ceil($number_of_results/$results_per_page);
// echo $number_of_pages;
if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }
  $this_page_first_result = ($page-1)*$results_per_page;
  $sql1='SELECT * FROM products LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $query1=$conn->query($sql1);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
  <?  foreach ($query1 as $key) {
 echo "<br>";


$files = glob($key['filename']."/*.*");

$id=$key['id'];

$url= "detail.php?id=".$id;


$image = $files[0];?>
    <a href="<?echo $url?>">

    <div class="card">
    
    
<img src="<?echo $image ?>" alt="Gallery #1"  /><br>
<h1> <? echo $key['product_name']?></h1>

</div>
</a>
<?

}

?>
    
    </div>
    <div class="pagination">
    <?
    for ($page=1;$page<=$number_of_pages;$page++) {?>
     <h3 style="margin:10px;">   <?echo '<a href="index.php?page=' . $page . '">' . $page . '</a> ';?></h3><?
      }
      ?>
</div>
</body>
</html>