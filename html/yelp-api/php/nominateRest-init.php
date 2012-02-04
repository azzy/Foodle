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
        <title> JQuery</title>
        <script type="text/javascript">
        function codeAddress() {
            doThis('ok');
        }
        function doThis(str) {
            alert(str);
        }
        window.onload = codeAddress;
        </script>
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
        
        <p id="test1">test1</p>
        <p id="test2">test2</p>
        <p id="test3">test3</p>
        <p id="test4">test4</p>

        <div id="searchstuff">
            
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
