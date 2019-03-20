<?php
include_once("database.php");

$sql="SHOW TABLES LIKE 'products'";
$query=$conn->prepare($sql);
$query->execute(); 
$result= $query->rowCount();
if($result==0)
{
    $query=$conn->prepare("CREATE TABLE products ( id int,product_name varchar(255),cost_price int,sell_price int,filename varchar(255),upload_on datetime NOT NULL)");
$query->execute();
echo "succesful";
}

print_r($_FILES['files']['name']);
$imageData = array();
if(isset($_POST['submit'])){
    $id=$_POST['product_id'];
    $name=$_POST["product_name"];
    $cost_price =$_POST['cost_price'];
    $sell_price=$_POST['sell_price'];

if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
        $file_name = $key.$_FILES['files']['name'][$key];
        echo $file_name;

		$file_tmp =$_FILES['files']['tmp_name'][$key];
        echo $file_tmp;
        
        array_push($imageData, $file_name);
       
        $desired_dir=$id."_".$name;
        echo $desired_dir;
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0755,true);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,$desired_dir."/".$file_name);
            }else{									
                			
            }
            		
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
		//echo "Success";
		//print_r($imageData);
		//echo sizeof($imageData);
		//for($i=0;$i<sizeof($imageData);$i++){
		//	echo $imageData[$i];			
		//}
		$imgDt = implode("|", $imageData);
		 $query="INSERT into products(`id`,`product_name`,`cost_price`,`sell_price`,`filename`) VALUES('$id','$name','$cost_price','$sell_price','$desired_dir'); ";
        // mysql_query($query);	
        $result=$conn->prepare($query);
        $result->execute();
	}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="insert.php" method="post" enctype="multipart/form-data">
    product id: <input type="text" name="product_id" id="product_id"><br>
    product name: <input type="text" name="product_name" id="product_name"><br>
    cost price: <input type="number" name="cost_price" id="cost_price"><br> 
    selling price: <input type="number" name="sell_price" id="sell_price"><br>
    Upload: <input type="file" name="files[]" id="images" multiple ><br>
    <input type="submit" name="submit" value="submit">
     </form>
</body>
</html>