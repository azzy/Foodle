/* Functions Used for Initial Population of Lists --------------------------- */
// function to load initial list for restaurant nomination page
function initiateRestNom (loc) {
    $.post("../functions/initRest.php",
	   { location: loc },
	   function(data) {
	       for (var i=0; i < data.num; i++) {
		   $("#sortable1").append(
		   '<li class="draggable heading" id="' + data[i].id + '">'
		       + data[i].name 
		       + '<ul class="info ui-state-disabled"><li class="yelprating ui-state-disabled"><img src="' 
		       + data[i].ratingimg + '" /></li><li class="yelpsnippet ui-state-disabled">'
		       + data[i].snippet + '</li><li class="yelpcat ui-state-disabled">'
		       + data[i].categories + '</li><li class="readmore ui-state-disabled">'
		       + data[i].url + '</li></ul></li>');
	       }
	   }, "json"
	  );
}

/* Functions Used for Search ------------------------------------------------ */
// function to retrieve yelp info
function search (loc) {
  // toggle on secondary buttons, toggle off main search button
  $('#addnew').show();
  $('#yelpdata').show();
  // retrieve the search text
  var searchTxt =  $("input#searchtxt").val();
  // get yelp data on the search text
    getYelp(searchTxt, loc);
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
function getYelp(str, loc) {
    $.post("../functions/searchRest.php", //ajax file
           { sendValue: str.
	     location: loc 
	   },
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
		       + '<ul class="info ui-state-disabled"><li class="yelprating ui-state-disabled"><img src="' 
		       + data.returnValueRatingImg + '" /></li><li class="yelpsnippet ui-state-disabled">'
		       + data.returnValueSnippet + '</li><li class="yelpcat ui-state-disabled">'
		       + data.returnValueCategory + '</li><li class="readmore ui-state-disabled">'
		       + data.returnValueURL + '</li></ul></li>');
               //empty inputs
               $("#searchstuff").find("input").val("");
               $('#yelpdata li').html("");
	       //initialize the new items to expand/collapse and be sortable
	       $("#sortable1").sortable({
		   items: ":not('.ui-state-disabled')"
	       });
	       $(".info").sortable({disabled: true});
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