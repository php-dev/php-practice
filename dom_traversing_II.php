<!DOCTYPE html>
<html>
<head>
  <style>

  p, div, span {margin:2px; padding:1px; }
  div { border:2px white solid; }
  span { cursor:pointer; font-size:12px; }
  .selected { color:blue; }
  b { color:red; display:block; font-size:14px; }
  </style>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
  <p>
    <div>
      <div><span>Hello</span></div>
      <span>Hello Again</span>

    </div>
    <div>
      <span>And Hello Again</span>
    </div>
  </p>

  <b>Click Hellos to toggle their parents.</b>
<script>
function showParents() {
  $("div").css("border-color", "white");
  
  var len = $("span.selected")
                   .parents("div")
                   .css("border", "2px red solid")
                   .length;
  //alert(len);                 
  $("b").text("Unique div parents: " + len);
}
$("span").click(function () {
  $(this).toggleClass("selected");
  showParents();
});</script>

</body>
</html>