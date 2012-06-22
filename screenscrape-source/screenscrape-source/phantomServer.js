/*
*	phantomServer.js
*
* Written by Tilo Mitra (www.tilomitra.com)
* May 29, 2012
*
* This code is meant to be used as a learning tool to get you started with PhantomJS-Node.
* The code below uses PhantomJS-Node and jQuery to pull content from a page with dynamic content.
* This code has not been tested thoroughly and is meant to be served as a guide only.
*
*/


var phantom = require('phantom');
phantom.create(function(ph) {
  return ph.createPage(function(page) {
    return page.open("http://tilomitra.com/repository/screenscrape/ajax.html", function(status) {
      console.log("opened site? ", status);			

			page.injectJs('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', function() {
				//jQuery Loaded.
				//Wait for a bit for AJAX content to load on the page. Here, we are waiting 5 seconds.
				setTimeout(function() {
					return page.evaluate(function() {
						
						//Get what you want from the page using jQuery.
						// A good way is to populate an object with all the jQuery commands that you need and then return the object.
						var h2Arr = [],
						pArr = [];
						$('h2').each(function() {
							h2Arr.push($(this).html());
						});
						$('p').each(function() {
							pArr.push($(this).html());
						});
						
						return {
							h2: h2Arr,
							p: pArr
						}
					}, function(result) {
						console.log(result);
						ph.exit();
					});
				}, 5000);
				
			});
    });
	});
});
