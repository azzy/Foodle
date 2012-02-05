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
	       var id = data.returnValueId;
               //add author name and comment to container
	       $("#sortable1").append(
		   '<li class="draggable heading added-sortable" id="' + id + '">'
		       + data.returnValueName 
		       + '<ul class="info"><li class="yelprating ui-state-disabled"><img src="' 
		       + data.returnValueRatingImg + '" /></li><li class="yelpsnippet ui-state-disabled">'
		       + data.returnValueSnippet + '</li><li class="yelpcat ui-state-disabled">'
		       + data.returnValueCategory + '</li><li class="readmore ui-state-disabled">'
		       + data.returnValueURL + '</li></ul></li>');
               //empty inputs
               $("#searchstuff").find("input").val("");
               $('#yelpdata li').html("");
	       //initialize the new items to expand/collapse and be sortable
	      /* $("#sortable1").sortable({
		   items: ":not('.info li')"
	       });*/
	      // $('#' + id + ".info").sortable({ disabled: true });
	       $('#' + id).children('.info').hide();
	       $('#' + id).click(function(event) {
		   if (this == event.target) $(this).children('ul').toggle();
	       });
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