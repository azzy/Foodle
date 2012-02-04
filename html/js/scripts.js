//Add Field to emails-form.
function add_field()
{
    var div1 = document.createElement('div');
    div1.innerHTML = document.getElementById('template').innerHTML;
    document.getElementById('emails-form').appendChild(div1);
}

// click on the add button to add yelp info to the html list    
$('#add').click(function () {
    // toggle secondary keys off and search key on
    $('.sec').toggle();
    $('#search').toggle();
    // info in box to list
    
    var searchTxt =  $("#searchstuff").find("textarea").val();
    // add yelp data to the list
    listYelp(searchTxt);
});
// get yelp data for display
function getYelp(str) {
    $.post("searchRest.php", //ajax file
           { sendValue: str },
           function(data) {
               dataStuff = data;
               $('<p>').addClass("yelpname").html(data.returnValueName + " " + data.returnValueId).appendTo('#yelpdata');
               $('<p>').addClass("yelprating").html(data.returnValueRating).appendTo('#yelpdata');
               $('<p>').addClass("yelpratingimg").html("<img src=" + data.returnValueRatingImg + " alt='rating'>").appendTo('#yelpdata');
               $('<p>').addClass("yelpsnippet").html(data.returnValueSnippet).appendTo('#yelpdata');
               $('<p>').addClass("yelpcat").html(data.returnValueCategory).appendTo('#yelpdata');
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
               $("#searchstuff").find("textarea").val("");
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
</script>
