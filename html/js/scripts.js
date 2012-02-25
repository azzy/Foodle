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
    
    $( ".column" ).disableSelection();
}
function initiateSortable () {
  //initialize sortables
  $('#sortable1, #sortable2').sortable( {
    items: ":not(.ui-state-disabled)",
    cursor: 'move',
    connectWith: ".connectedSortable",
    dropOnEmpty: true
  });
  $("#sortable1, #sortable2").disableSelection();
}

function initiateExpandCollapse () {
  // initialize expand/collapse list
  $('li.heading').children('.info').hide();
  $('li.heading').each( function() {
      $(this).click(function(event) {
	  if (this == event.target) $(this).children('ul').toggle();
	});
    });
}

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
		   $('#' + data[i].id).children('.info').hide();
		   $('#' + data[i].id).each( function() {
		       $(this).click(function(event) {
			   if (this == event.target) $(this).children('ul').toggle();
		       });
		   });
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
	       $( ".portlet-header" ).click(function() {
		   $( this ).parents( ".portlet" ).find( ".portlet-content" ).toggle();
	       });
	       // initialize the new items to expand/collapse and be sortable
	       /*$("#sortable1").sortable({
		   items: ":not('.ui-state-disabled')"
	       });
	       $(".info").sortable({disabled: true});*/
	       // $('#' + id + ".info").sortable({ disabled: true });
	       /*$('#' + id).children('.info').hide();
	       $('#' + id).click(function(event) {
		   if (this == event.target) $(this).children('ul').toggle();
	       });*/
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