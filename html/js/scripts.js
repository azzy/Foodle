<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="./json2.js"></script>
<script type="text/javascript">

    //Initialize the page (This function runs on pageload)
    $(function () {
        $('.sec').toggle();
    });
    
    // when doc is ready, if search button is clicked retrieve yelp info
    $(document).ready(function() {
        $('#search').click(function () {
                // toggle on secondary buttons, toggle off main search button
                $('.sec').toggle();
                $('#search').toggle();
                // retrieve the search text
                var searchTxt =  $("#searchstuff").find("textarea").val();
                // get yelp data on the search text
                getYelp(searchTxt);
                
        });
    });
    
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
