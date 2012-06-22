<!DOCTYPE html>
<html>
<head>
  <style>
  ul { float:left; margin:5px; font-size:16px; font-weight:bold; }
  p { color:blue; margin:10px 20px; font-size:16px; padding:5px; 
      font-weight:bolder; }
  .hilite { background:yellow; }
  .hilite_sib { background:red; }
</style>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script language="javascript">
      function showParents() {
  $("div").css("border-color", "white");
  
      var len = $("span.selected")
                       .parents("div")
                       .css("border", "2px red solid")
                       .length;
      //alert(len);                 
      $("b").text("Unique div parents: " + len);
}
$(function () {
    //alert('daa');
    $(".test").click(function () {
        //$(this).toggleClass("selected");
        var len = $(this).siblings().length;
        //alert(len);
        $(this).siblings() 
               .addClass("hilite_sib")
               .removeClass('hilite')
               .end()
               .addClass("hilite")
               .removeClass('hilite_sib').end();                  

        //$(this).nextAll().text(len);
        $(this).parent().next().html(len).prepend();
       // $(this).parent().css("border","solid 2px black");
        //$(this).offsetParent().css("border","solid 2px blue");
        //showParents();
        var parentEls = $(this).parent().next()
            .map(function () { 
                  return this.tagName; 
                })
            .get().join(", ");
        var parentEls_arr = parentEls.split(',');
        alert(parentEls);    
        
    });
});
  </script>
</head>
<body>
    <div class="ul_list">
  <ul>
    <li class='test'>One</a></li>
    <li class='test'>Two</li>
    <li class="test">Three</li>
    <li class='test'>Four</li>
  </ul>
   <span><p>This Siblings: <b></b></p></span>

  <ul>
    <li class='test'>Five</li>
    <li class='test'>Six</li>
    <li class='test'>Seven</li>

  </ul>
         <p>This Siblings: <b></b></p>
    </div>
 
<script>

</script>

</body>
</html>