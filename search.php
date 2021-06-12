<?php

// Connect to DB
$conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "b5a264c5c9d4c6","b8abe23f","heroku_e6cf41e0044a150");      //$db=mysqli_select_db($connect,"bollywood");
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
