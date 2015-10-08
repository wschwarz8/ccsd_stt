
var firstButtonPressed = function(){//make a alert message pop up
	alert("You pressed my button and found that it makes an annoying popup!");
};

var secondButtonPressed = function(){//make a confirm dialoge pop up
	confirm("Please answer ok if you saw this message");	
};

var thirdButtonPressed = function(){//make a prompt pop up
	var message = prompt("What is your favorite Color?");
	if (message === "blue"){
		document.getElementById("tbct").innerHTML = "My favorite color is blue too!";
	}else if (message ==="Blue"){
		document.getElementById("tbct").innerHTML = "My favorite color is blue too!";
	}else{
		document.getElementById("tbct").innerHTML = "Your Favorite color is " + message + " and my favorite color is blue";
	}
};
