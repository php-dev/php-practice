<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>
<html>
<head>
  <style>

  span { color:blue; font-weight:bold; }
  button { width:100px; }
  </style>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script language="javascript">
      $(function () {
          $("button[disabled]").nextAll().text("this button is disabled");
          //alert($("button[disabled]").parent().nextAll().length); 
          if($("button[disabled]").parent().nextAll().length == 0) {
            $('#news ul li:first-child').addClass('active');
          }else {
            $("button[disabled]").parent().next().addClass('active');
          }
          
      });
      
  </script>
</head>
<body>
  <div><button disabled="disabled">First</button> - <span></span></div>
  <div><button>Second</button> - <span></span></div>

  <div><button disabled="disabled">Third</button> - <span></span></div>


</body>
</html>