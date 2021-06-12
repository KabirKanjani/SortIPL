      <!DOCTYPE html>
      <html lang="en">

            <head>
               <!-- <meta name="viewport" content="width=device-width, initial-scale=4"> -->
              <title>SortIPL</title>
              <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
              <!-- <link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'"> -->
      <!-- <noscript> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!-- </noscript> -->

              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

              <style>
              table
              {
                  background-color: white;
                  margin:0;
              }
              img
              {
                  margin-left: 40%;
                  margin-top: 5%;
                  size:20%;
              }
              label
              {
                  font-size: 5vh;
                  color: black;
              }
              td
              {
                 /* color: white; */
                font-size: 25px;

              }
              body, html {
                min-height:100%;
                 height: 100vh;  /* if not working try vh instead of % */
              }
              input[type="text"],input[type="number"]
              {
                height: 3.5vh;
              }

                             body
                  {
                    margin:0px;
                     color: white;
                    font-size:1vw;
                      background:url('Pictures/Mi.png') top center repeat-y;
                      background-repeat: no-repeat;  /* Background Image Will not repeat */
                      background-attachment: fixed;  /* Background Image will stay fixed */
                      background-size: cover;
                       /* background-size: 100%; */
                       image-rendering: -webkit-optimize-contrast;
                  }
                  .bg-image
                  {
                      background:url('Pictures/Mi.jpg') top center repeat-y;

                  }
                          {
                            ::placeholder
                            font-size: 4vh;
                          }
              ul{
                background-color:black;
                color:white;
                cursor: pointer;
              }
              li
              {
              padding:12px;
              }
              </style>
            </head>
            <body>

              <br><br>
              <div class="container" style='width:100%;'>
                <h3 align="center">Search Player and Enter the Minimum Runs Scored:</h3>
                <br>
                <form action="abd.php" name="form1" method="POST" class="form-group">
                <br>
                <label for="score">Enter Runs:</label><br>
                <div class="block">
                <input type="number" name="score" max="175" min="1" id="score" class="form-control w-25 p-3" placeholder="Enter Runs">
              </div>
                <br><br>
                <label for="score">Enter Players Name:</label>
                <div class="block">
                <input type="text" name="player"  autocomplete="off" id="player" class="form-control w-50 p-3" placeholder="Enter Player Name">
              </div>
                  <div id="playerlist" name="playerlist">
                  </div>
                  <br><input type="submit" value="Find" class="btn btn-light btn-outline-dark btn-lg mb-2">
                </form>
              </div>
              </div>
            </body>

      <?php
      if(isset($_POST['player'])&&isset($_POST['score'])&&!empty($_POST['player'])&&!empty($_POST['score']))
      {
        checkname($_POST['player'],$_POST['score']);
      }
      function checkname($oname,$runs)
      {
        echo "
        <br><br><br>
        <table class='table table-hover table-light'>
        <thead class=thead-dark>
        <tr>
        <center><th colspan=5 style='text-transform: uppercase; text-align:center;'>IPL Matches where ".$_POST['player']." has Score of ".$_POST['score']." or more</th></center>
        </tr>
        <tr>
        <th>Team1</th>
        <th>Team2</th>
        <th>Score</th>
        <th>Year</th>
        <th>Link</th>
        </tr>
        </thead>
        ";

        // Connect to DB
        $connect = mysqli_connect("us-cdbr-east-04.cleardb.com", "b5a264c5c9d4c6","b8abe23f","heroku_e6cf41e0044a150");      //$db=mysqli_select_db($connect,"bollywood");

            $query="select Pid from all_player where Pname='".$oname."'";
            if($query_run=mysqli_query($connect,$query))
            {
              $data=mysqli_fetch_assoc($query_run);
              if(empty($data['Pid']))
              {

              }
                else{
              $id=$data['Pid'];
              $query="select Mid,Score from lastdata where Pid='P".$id."' AND Score>='".$runs."'";
                if($query_run=mysqli_query($connect,$query))
                {
                      while($data=mysqli_fetch_array($query_run))
                      {
                            $score=$data['Score'];
                              echo "<tr>";
                              $query2="Select * from ipl where id='".$data['Mid']."'";
                              // echo $query2;
                              if($query_run1=mysqli_query($connect,$query2))
                              {

                                $data=mysqli_fetch_assoc($query_run1);
                                echo "<td>".$data['Team1']."</td>";
                                echo "<td>".$data['Team2']."</td>";
                                echo "<td>".$score."</td>";
                                echo "<td>".$data['Year']."</td>";
                                $link=$data['Link'];
                                echo "<td><a href=".$link." target='_blank'>Link</a></td>";
                              }
                              echo "</tr>";
                            }
                          }
                        }
                        }
            echo "</Table>";
      }
      ?>
      <script>

      $(document).ready(function()
        {
            $('#player').keyup(function(){
              var query=$(this).val();
              if(query!='')
              {
                $.ajax(
                  {
                    url:"search.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#playerlist').fadeIn();
                      $('#playerlist').html(data);
                    }
                  }
                );
              }
              else {
                $('#playerlist').fadeOut();
                $('#playerlist').html("");
              }
            });
            $(document).on('click','li',function(){
              $('#player').val($(this).text());
              $('#playerlist').fadeOut();
            });
        }
      );
      </script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      </html>
