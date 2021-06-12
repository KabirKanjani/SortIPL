<?php

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["us-cdbr-east-04.cleardb.com"];
$cleardb_username = $cleardb_url["b5a264c5c9d4c6"];
$cleardb_password = $cleardb_url["b8abe23f"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;

    $connect=mysqli_connect($cleardb_server,$cleardb_username,$cleardb_password,$cleardb_db);

if(isset($_POST['query']))
{
  $output='';
  $query="Select * from all_player where Pname Like '%".$_POST["query"]."%'";
  $result=mysqli_query($connect,$query);
  $output='<ul class="list-unstyled">';
  if(mysqli_num_rows($result)>0)
  {
    while($row=mysqli_fetch_array($result))
    {
      $output.='<li>'.$row["Pname"].'</li>';
    }
  }
  else
  {
      $output.='<li>Player not found</li>';
  }
  $output.='<ul>';
  echo $output;
}



 ?>
