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
            
            <p> Yelp Data should print under here </p>
            <p id = "yelpdata">
                <p id="yelpname"></p>
                <p id="yelprating"></p>
                <p id="yelpratingimg"></p>
                <p id="yelpsnippet"></p>  
                <p id="yelpcat"></p>                  
            </p>
            <p id="test1">test1</p>
            <p id="test2">test2</p>
            <p id="test3">test3</p>
            <p id="test4">test4</p>
            
            <br>
            <br>
        </div>
    </body>
</html>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="./json2.js"></script>
<script type="text/javascript">

    //Initialize the page (This function runs on pageload)
    
    
    $(function() {
        $('#test1').text("here-1");
        var location = "08544";
        //addYelp(location);
        $('#test2').html("here-2");
        
    });
    //window.onload=start;
    
    function addYelp(str) {
        $.post("initRest.php", //ajax file
        { sendValue: str },
        function(data) {
            $('#test3').html("here");
            $('#test4').html(data.num);
            $('#yelpratingimg').html(data.0.name);
            for (var i = 0; i < 8; i++) {
                //$('<li>').addClass("restaurant").html(data.$i.name).appendTo('#restlist');
                $("<li>").addClass("restaurant").text(data.$i.name).appendTo("#restlist");
            }
        },
        "json"
        );
    }
    
    
    
    // when doc is ready, if search button is clicked retrieve yelp info
    $(document).ready(function() {
        /*
        $('#search').click(function () {
                // toggle on secondary buttons, toggle off main search button
                $('.sec').toggle();
                $('#search').toggle();
                // retrieve the search text
                var searchTxt =  $("#searchstuff").find("textarea").val();
                // get yelp data on the search text
                getYelp(searchTxt);
                
        });
        */
    });
    /*
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
    */
    
</script>
