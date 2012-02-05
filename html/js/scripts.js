// function to retrieve yelp info
function search () {
  // toggle on secondary buttons, toggle off main search button
  $('#addnew').show();
  $('#yelpdata').show();
  // retrieve the search text
  var searchTxt =  $("input#searchtxt").val();
  // get yelp data on the search text
  getYelp(searchTxt);
}

// click on the add button to add yelp info to the html list    
function addYelpInfo () {
    // toggle secondary keys off and search key on
    $('#addnew').hide();
    $('#yelpdata').hide();
    // info in box to list
    
    var searchTxt =  $("#searchstuff").find("input").val();
    // add yelp data to the list
    listYelp(searchTxt);
}

// get yelp data for display
function getYelp(str) {
    $.post("../functions/searchRest.php", //ajax file
           { sendValue: str },
           function(data) {
               //dataStuff = data;
	       $("#yelpdata ul").attr('id', data.returnValueId);
               $("#yelpdata li.yelpname").html(data.returnValueName);
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
    $.post("../functions/searchRest.php", 
           { sendValue : str },
           function(data) {
               //var li = $("<li>").addClass("restaurant");            
               //add author name and comment to container
	       $("sortable1").append(
		   '<li class="draggable heading" id="' 
		       + data.returnValueId + '">'
		       + data.returnValueName 
		       + '<ul class="info"><li class="yelprating"><img src="' 
		       + data.returnValueRatingImg + '" /></li><li class="yelpsnippet">'
		       + data.returnValueSnippet + '</li><li class="yelpcat">'
		       + data.returnValueCategory + '</li><li class="readmore">'
		       + data.returnValueURL + '</li></ul></li>');
              // $("<li>").addClass("restaurant").text(data.returnValueName + " " + data.returnValueId).appendTo("#sortable1");
               //empty inputs
               $("#searchstuff").find("input").val("");
               $('#yelpdata li').html("");
           },
           "json"
          );            
}

function close () {
    $('#addnew').hide();
    $('#yelpdata').hide();
    $("#searchstuff").find("input").val("");
    $('#yelpdata li').html("");
}