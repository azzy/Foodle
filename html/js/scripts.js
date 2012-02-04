// function to retrieve yelp info
function search () {
  // toggle on secondary buttons, toggle off main search button
  $('#addnew').toggle();
  $('#yelpdata').toggle();
  // retrieve the search text
  var searchTxt =  $("#searchstuff").find("input").val();
  // get yelp data on the search text
  getYelp(searchTxt);
}

// click on the add button to add yelp info to the html list    
function addYelpInfo () {
    // toggle secondary keys off and search key on
    $('#addnew').toggle();
    $('#search').toggle();
    // info in box to list
    
    var searchTxt =  $("#searchstuff").find("input").val();
    // add yelp data to the list
    listYelp(searchTxt);
}

// get yelp data for display
function getYelp(str) {
    $.post("../php/searchRest.php", //ajax file
           { sendValue: str },
           function(data) {
               dataStuff = data;
               $("#yelpdata li.yelpname").html(data.returnValueName + " " + data.returnValueId);
	       $("#yelpdata li.yelprating").html('<img src="' + data.returnValueRatingImg + '" />');
	       $("#yelpdata li.yelpsnippet").html(data.returnValueSnippet);
	       $("#yelpdata li.yelpcat").html(data.returnValueCategory);
	       $("#yelpdata li.readmore").html(data.returnValueURL);
           },
           "json"
          );
}
// add yelp data to list
function listYelp(str) {
    $.post("searchRest.php", 
           { sendValue : str },
           function(data) {
               //var li = $("<li>").addClass("restaurant");            
               //add author name and comment to container
               $("<li>").addClass("restaurant").text(data.returnValueName + " " + data.returnValueId).appendTo("#restlist");
               //empty inputs
               $("#searchstuff").find("input").val("");
               $('#yelpdata').html("");
           },
           "json"
          );            
}

$('#back').click(function () {
    $('.sec').toggle();
    $('#search').toggle();
    $("#searchstuff").find("textarea").val("");
    $('#yelpdata').html("");
});