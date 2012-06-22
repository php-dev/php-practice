<%
Set dataNow = Server.CreateObject("ADODB.Connection") 
dataNow.Open("Driver={MySQL ODBC 3.51 Driver};Server=localhost;DATABASE=wrd-test;USER=root;PASSWORD=aslangs;OPTION=3")
dataNow.execute("SET NAMES 'utf8'")

lastID = Request.QueryString("lastID")
action = Request.QueryString("action")
Set RS999=Server.CreateObject("ADODB.RecordSet")

'We need to include the JS files and other standard HTML files here in order not to load them in every scroll.
If action <> "getLastPosts" Then 
%>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	</head>
	<link rel="stylesheet" href="css.css" type="text/css" />
	<script type="text/javascript" src="jquery-1.2.6.pack.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
		
		$('form#mainForm').bind('submit', function(e){
			e.preventDefault();
			checkForm();
		});
		
		$('input#hostName').focus();
	
		
		function lastPostFunc() 
		{ 
			$('div#lastPostsLoader').html('<img src="bigLoader.gif">');
			$.post("scroll.asp?action=getLastPosts&lastID="+$(".wrdLatest:last").attr("id"),
	
			function(data){
				if (data != "") {
				$(".wrdLatest:last").after(data);			
				}
				$('div#lastPostsLoader').empty();
			});
		};  
		
		$(window).scroll(function(){
			if  ($(window).scrollTop() == $(document).height() - $(window).height()){
			   lastPostFunc();
			}
		}); 
		
	});
	</script>
	
	
	<body>
	
<%
		'The content loaded when the page is first loaded start
		SQL="SELECT * FROM test ORDER BY testID DESC LIMIT 20"
		RS999.Open SQL,dataNOW,1,1
		While Not RS999.EOF
%>
			<div class="wrdLatest" id="<%=RS999("testID")%>">
				<div class="xtop"><div class="xb1"></div><div class="xb2"></div><div class="xb3"></div><div class="xb4"></div></div>
				<div class="xboxcontent">
					<%=RS999("testName")%>
				</div>
				<div class="xbottom"><div class="xb4"></div><div class="xb3"></div><div class="xb2"></div><div class="xb1"></div></div>
			</div>
		<%
		RS999.MoveNext
		Wend
		RS999.Close
		'The content loaded when the page is first loaded end
		%>
		
		<div id="lastPostsLoader">
		
	</body>
	</html>
		
<%	
Else
	'When User Scrolls This Query Is Run Start
	getPostsText = ""
	SQL="SELECT * FROM test WHERE testID < "&lastID&" ORDER BY testID DESC LIMIT 5"
	RS999.Open SQL,dataNOW,1,1
	While Not RS999.EOF

		getPostsText = getPostsText & "<div class=""wrdLatest"" id=""" & RS999("testID") & """>"
		getPostsText = getPostsText & "<div class=""xtop""><div class=""xb1""></div><div class=""xb2""></div><div class=""xb3""></div><div class=""xb4""></div></div>"
		getPostsText = getPostsText & "<div class=""xboxcontent"">" & RS999("testName") & "</a></div>"
		getPostsText = getPostsText & "<div class=""xbottom""><div class=""xb4""></div><div class=""xb3""></div><div class=""xb2""></div><div class=""xb1""></div></div></div>"

	RS999.MoveNext
	Wend
	RS999.Close
	Response.Write getPostsText 'Writes The Result Of The Query
	'When User Scrolls This Query Is Run End
End If
%>