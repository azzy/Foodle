/* Functions Used for Initial Population of Lists --------------------------- */
// function to load initial list for restaurant nomination page
function initiatePortlets () {
    // initialize sortables
    $( ".column" ).sortable({
	connectWith: ".column",
	items: ".portlet:not(.bin)"
    });
    
    // initialize expand/collapse
    $( ".portlet-header" ).click(function() {
	$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
    });

    $( ".portlet-content" ).hide();
    
    $( ".column" ).disableSelection();
}

function initiatePortletToggle(i) {
    // initialize expand/collapse
    $( ".portlet-header #" + i ).click(function() {
	$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
    });

    $( ".portlet-content" ).hide();
}

function initiateToggle() {
    // this is the real function to initialize expand/collapse.
    // I just wasn't sure if I could delete the one above without breaking things
    // and I kind of want to go to sleep :P also apparently it doesn't work when
    // I try to call it from here.
    $( ".portlet-header" ).click(function() {
    $( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
  });

    $(".portlet-content").hide();
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
function addYelpInfo (loc) {
    // toggle secondary keys off and search key on
    $('#addnew').hide();
    $('#yelpdata').hide();
    // info in box to list
    
    var searchTxt =  $("#searchtxt").val();
    // add yelp data to the list
    listYelp(searchTxt, loc);
}

// get yelp data for display
function getYelp(str, loc) {
    $.post("../functions/searchRest.php", //ajax file
           { sendValue: str,
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
function listYelp(str, loc) {
    $.post("../functions/searchRest.php", 
           { sendValue : str,
	     location: loc
	   },
           function(data) {
	       var id = data.returnValueId;
               // add author name and comment to container
	       $("#sortable1").append(
		   '<div class="portlet" id="' + id + '">' +
		   '<div class="portlet-header">'
		       + data.returnValueName + '</div><div class="portlet-content">'
		       + '<ul><li class="yelprating"><img src="' 
		       + data.returnValueRatingImg + '" /></li><li class="yelpsnippet">'
		       + data.returnValueSnippet + '</li><li class="yelpcat">'
		       + data.returnValueCategory + '</li><li class="readmore">'
		       + data.returnValueURL + '</li></ul></div></div>');
               // empty inputs
               $("#searchstuff").find("input").val("");
               $('#yelpdata li').html("");

	       // initialize new items to toggle
	       $( "#" + id + " .portlet-header" ).click(function() {
		   $( this ).parents( "#" + id ).find( ".portlet-content" ).toggle();
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