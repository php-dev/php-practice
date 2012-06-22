<!DOCTYPE html>
<html>
<head>
  <style>
  b, span, p, html body {
    padding: .5em;
    border: 1px solid;
  }
  b { color:blue; }
  strong { color:red; }
  </style>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
  <div>
    <p>
      <span>
        <b>My parents are: </b>
      </span>

    </p>
  </div>
<script>
var parentEls = $("b").parents()
            .map(function () { 
                  return this.tagName; 
                })
            .get().join(", ");
$("b").append("<strong>" + parentEls + "</strong>");

</script>

</body>
</html>