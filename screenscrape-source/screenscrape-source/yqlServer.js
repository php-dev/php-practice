/*
*	yqlServer.js
*
* Written by Tilo Mitra (www.tilomitra.com)
* May 29, 2012
*
* This code is meant to be used as a learning tool to get you started with the node-yql module.
* The code below uses the data.html.cssselect table to pull the headlines from Nettuts.
*
*/

var YQL = require("yql");

new YQL.exec('select * from data.html.cssselect where url="http://net.tutsplus.com" and css=".post_title a"', function(response) {
	
	console.log(response.results);
	
});