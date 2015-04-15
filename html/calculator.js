$(document).ready(function(){
	$("#undoredeem").click(function(){
		var custid = $("#customerid").val();
		var text = 10;
		var redeemed = "redeem";
		
		$.post("/freebies/calculateAdd", {updatenum: text, customerid: custid, redeem: redeemed}, function(data){
		$("#systemPoints").html(data).show();
		console.log(data);
		$("#summary").text($("#summary").text()+"+10 (undo)");
		
	}) //end post
	}) //end function


	$("#redeem").click(function(){
		var custid = $("#customerid").val();
		var text = 10;
		var redeemed = "redeem";
		
		$.post("/freebies/calculateSubtract", {updatenum: text, customerid: custid, redeem: redeemed}, function(data){
		$("#systemPoints").html(data).show();
		console.log(data);
		$("#summary").text($("#summary").text()+"-10 (redeem)");
	}) //end post
	}) //end function
	
    $(".numberButtons").click(function()
    {
        //  get current calculator display
        var currentDisplay = $("#calc_display").text();

        //  new display
        var newDisplay;

        //  set btnText = to the button value
        var btnText = $(this).val();

        //  if currentDisplay has no value
        if (currentDisplay == 0)
        {
            //  set newDisplay = button value clicked
            newDisplay = btnText;
        }
        //  if the display digits are < 2; add btnClick to display
        else if (currentDisplay.length < 2)
        {
            //  add a second value to calc_display
            newDisplay = currentDisplay + btnText;
        }

        //  set the calc_display = to the newDisplay
        $("#calc_display").text(newDisplay);

    });
	
    $("#add").click(function()
    {
		
		
	
        //  get current calculator display
        var currentDisplay = $("#calc_display").text();

        //  if there is no value assign a 0
        if (currentDisplay == "")
        {
            currentDisplay = 0;
        }

        //  convert calc_display to INT
        currentDisplay = parseInt(currentDisplay);

        //  get the current points
        var oldPoints = $("#customerPoints").text();

        //  had to set this to 0 to get around NAN if no value exists
        if (oldPoints == "")
        {
            oldPoints = 0;
        }

        //  converst oldPoints to INT in case it isn't already
        oldPoints = parseInt(oldPoints);

        //  variable for new point display
        var points = oldPoints + currentDisplay;

        //  assign the points element the points value
        $("#customerPoints").text(points);

        //  set the calculator display to empty
        $("#calc_display").text("");
		
		$("#summary").text($("#summary").text()+"+"+points);
		var custid = $("#customerid").val();
		var text = $("#customerPoints").text();
		var redeemed = "not";
		
		$.post("/freebies/calculateAdd", {updatenum: text, customerid: custid, redeem: redeemed}, function(data){
		$("#systemPoints").html(data).show();
		console.log(data);
		clearfunction();
		
		
		});
		
		
		
    });
		
		function clearfunction(){
		var clearit = document.getElementById("customerPoints");
		clearit.innerHTML="";
		}
		
		
    $("#minus").click(function()
    {
        //  get current calculator display
        var currentDisplay = $("#calc_display").text();

        //  if there is no value assign a 0
        if (currentDisplay == "")
        {
            currentDisplay = 0;
        }

        //  convert calc_display to INT
        currentDisplay = parseInt(currentDisplay);

        //  get the current points
        var oldPoints = $("#customerPoints").text();

        //  had to set this to 0 to get around NAN if no value exists
        if (oldPoints == "")
        {
            oldPoints = 0;
        }

        //  converst oldPoints to INT in case it isn't already
        oldPoints = parseInt(oldPoints);
		
		if (currentDisplay > parseInt($("#systemPoints").text()))
        {
            alert("You can't take away more points than the customer has.");
        }
		else{
        
            //  variable for new point display
            var points = oldPoints + currentDisplay;

            //  assign the points element the points value
            $("#customerPoints").text(points);
        

        //  set the calculator display to empty
        $("#calc_display").text("");
		
		$("#summary").text($("#summary").text()+"-"+points);
		
		var custid = $("#customerid").val();
		var text = parseFloat($("#customerPoints").text());
		var redeemed = "not";
		
		$.post("/freebies/calculateSubtract", {updatenum: text, customerid: custid, redeem: redeemed}, function(data){
		$("#systemPoints").html(data).show();
		console.log(data);
		clearfunction();
		});
		}//end else
		
    })

    $("#clear").click(function()
    {
        //  set calc_display = nothing
        $("#calc_display").text("");
		clearfunction();
    });

});
