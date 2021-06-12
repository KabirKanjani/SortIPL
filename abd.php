<?php
function checkgame($oname,$score)
{
      $connect=mysqli_connect("localhost:3308","root","","ipl");
      //$db=mysqli_select_db($connect,"bollywood");
              $query="select Pid from all_player where Pname='".$oname."'";
              if($query_run=mysqli_query($connect,$query))
              {
                $data=mysqli_fetch_assoc($query_run);
                $id=$data['Pid'];
                echo $id;
                $query="select Mid from lastdata where Pid='P".$id."' AND Score>='".$score."'";
                echo $query;
                  if($query_run=mysqli_query($connect,$query))
                  {
                    echo "<br>";
                        while($data=mysqli_fetch_array($query_run))
                        {
                          echo $data['Mid']."<br>";
                          $nquery="Select * from ipl where id='".$data['Mid']."'";
                          if($query_run1=mysqli_query($connect,$nquery))
                            {
                              $data=mysqli_fetch_array($query_run1);
                              echo "<br>";
                              echo $data['Team1']." ";
                              echo $data['Team2']." ";
                              echo $data['Year']." ";
                              echo $data['Link']." ";
                              echo "<br>";
                            }
                        }
                  }
              }
}

?>
