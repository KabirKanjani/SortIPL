<?php

$connect=mysqli_connect("localhost:3308","root","","ipl");
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
