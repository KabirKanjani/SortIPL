<?php
function checkname($oname,$runs)
{
      $connect=mysqli_connect("localhost:3308","root","","ipl");
      //$db=mysqli_select_db($connect,"bollywood");
        for($i=1;$i<824;$i++)
        {
            for($j=1;$j<23;$j++)
            {
              $query="select P".$j." from players where Mid=".$i;
              if($query_run=mysqli_query($connect,$query))
              {
                $data=mysqli_fetch_assoc($query_run);
                $no="P".$j;
                $name=$data[$no];
                if($oname==$name)
                {
                    $query1="select P".$j." from score where Mid=".$i;
                    if($query_run=mysqli_query($connect,$query1))
                    {
                      $data=mysqli_fetch_assoc($query_run);
                      $no="P".$j;
                      $score=$data[$no];
                      if($score>=$runs)
                      {
                        $query2="select Link from ipl where id=".$i;
                        // echo $query2;
                        if($query_run=mysqli_query($connect,$query2))
                        {
                          $data=mysqli_fetch_assoc($query_run);
                          $link=$data['Link'];
                          echo "<a href=".$link.">Link</a><br>";
                        }
                      }
                    }
              }
            }
        }
      }
}
// checkname("Virat Kohli",0);
?>
