<!DOCTYPE html>
<html lang="en">

      <head>
        <title>SortIPL</title>
        <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
        <!-- <link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'"> -->
<!-- <noscript> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- </noscript> -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        *{
          font-family: 'Poppins',sans-serif;
        }
        .container{
          max-width: 700px;
          width: 100%;
          background-color: #fff;
          padding: 25px 30px;
          border-radius: 5px;
          box-shadow: 0 5px 10px rgba(0,0,0,0.15);
        }
        .container .title{
          font-size: 25px;
          font-weight: 500;
          position: relative;
        }
        .container .title::before{
          content: "";
          position: absolute;
          left: 0;
          bottom: 0;
          height: 3px;
          width: 30px;
          border-radius: 5px;
          background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }
        .content form .user-details{
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
          margin: 20px 0 12px 0;
        }
        form .user-details .input-box{
          margin-bottom: 15px;
          width: calc(100% / 2 - 20px);
        }
        form .input-box span.details{
          display: block;
          font-weight: 500;
          margin-bottom: 5px;
        }
        .user-details .input-box input{
          height: 45px;
          width: 100%;
          outline: none;
          font-size: 16px;
          border-radius: 5px;
          padding-left: 15px;
          border: 1px solid #ccc;
          border-bottom-width: 2px;
          transition: all 0.3s ease;
        }
        .user-details .input-box input:focus,
        .user-details .input-box input:valid{
          border-color: #9b59b6;
        }
         form .button{
           height: 45px;
           margin: 35px 0
         }
         form .button input{
           height: 100%;
           width: 100%;
           border-radius: 5px;
           border: none;
           color: #fff;
           font-size: 18px;
           font-weight: 500;
           letter-spacing: 1px;
           cursor: pointer;
           transition: all 0.3s ease;
           background: linear-gradient(135deg, #71b7e6, #9b59b6);
         }
         form .button input:hover{
          /* transform: scale(0.99); */
          background: linear-gradient(-135deg, #71b7e6, #9b59b6);
          }
        form .user-details .input-box{
            margin-bottom: 15px;
            width: 100%;
          }
          form .category{
            width: 100%;
          }
          .content form .user-details{
            max-height: 300px;
            overflow-y: scroll;
          }
          .user-details::-webkit-scrollbar{
            width: 5px;
          }
          }
          @media(max-width: 459px){
          .container .content .category{
            flex-direction: column;
          }
        }

        table
        {
            background-color: white;
        }
        img
        {
            margin-left: 40%;
            margin-top: 5%;
            size:20%;
        }
        input[type="text"],input[type="number"]
        {
          height: 3.5vh;
        }

        td
        {
           /* color: white; */
          font-size: 25px;

        }

        label
        {
            font-size: 15px;
            color: black;
        }
                       body
            {
              margin:0px;
               /* color: white; */
              /* font-size:1vw; */
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
              ::placeholder
                    {
                      font-size: 13px;
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
        <div class="container">
            <div class="title">Enter Score and Player name.</div>
            <label>This will find all the IPL matches where the mentioned player has scored equal to or more than the mentioned runs.</label>

            <form action="https://sortipl.herokuapp.com/" method="POST">

                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Enter Score:</span>
                        <input type="number" name="score" max=175 min=1 placeholder="Enter Runs">
                    </div>
                    <div class="input-box">
                        <span class="details">Enter Name:</span>
                        <input type="text" name="player"  autocomplete="off" id="player" class="form-control" placeholder="Enter Player Name">
                        <div id="playerlist" name="playerlist">
                        </div>
                    <div class="button">

             <input type="submit" value="Find">
           </div>
                </div>
            </form>
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

        $connect = mysqli_connect("us-cdbr-east-04.cleardb.com", "b5a264c5c9d4c6","b8abe23f","heroku_e6cf41e0044a150");      //$db=mysqli_select_db($connect,"bollywood");      //$db=mysqli_select_db($connect,"bollywood");
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
