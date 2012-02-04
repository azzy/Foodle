<html>
    <style>
                
        .inputbox
        {
            background-color: #BEF1CB;
            position: fixed;
            top: 200px;
            left: 400px;
            height: 100px;
            width: 200px;
        }
        


        
    </style>


    <head>
        <title>JQuery</title>
    </head>

    <body>
        
        <h1 id="maintitle" class="aheader">Search for your restaurant</h1>

        <ul id="restlist">
            <div id="restlist-div">
            <li class="restaurant">Restaurant 1</li>
            <li class="restaurant">Restaurant 2</li>
            <li class="restaurant">Restaurant 3</li>
            </div>
        </ul>

        <div id="searchstuff">
            <div class="searchtext"><label>Search:</label><textarea id = "searchtxt" cols="20" rows="1"></textarea></div>
			<button id="search">Search</button>
            
            <div class="sec">
                <!-- <img src="plus-sm.png" alt="plus" id="plus"/><img src="X.jpg" alt="x" id="x"/> -->
                <button id="add">Add To List</button> <button id="back">Back</button>
            </div>
            <p> Yelp Data should print under here </p>
            <p id = "yelpdata">
                <p id="yelpname"></p>
                <p id="yelprating"></p>
                <p id="yelpratingimg"></p>
                <p id="yelpsnippet"></p>  
                <p id="yelpcat"></p>                  
            </p>
            <br>
            <br>
        </div>
    </body>
</html>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="./json2.js"></script>
<script type="text/javascript">

    //Initialize the page (This function runs on pageload)
    $(function () {
        $('.sec').toggle();
        var location = "08544";
        addYelp = addYelp(location);
        
    });
    
    function addYelp(str) {
        $.post("initRest.php", //ajax file
        { sendValue: str },
        function(data) {
            $('#yelpdata').html(data);
            for (var i = 0; i < data.num; i++) {
                $('<li>').addClass("restaurant").html(data.$i.name).appendTo('#restlist');
            }
        },
        "json"
        );
    }
    
    
    
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
