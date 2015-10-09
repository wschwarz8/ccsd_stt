var testnumber1 = 1;

var hidetext = function() {   
	if (testnumber1 === 1){
		testnumber1 = 2;
	document.getElementById("hidetexts").innerHTML = "<a href='javascript:;' onclick='hidetext()'>Show</a>";
	}else{
		testnumber1 = 1;
	document.getElementById("hidetexts").innerHTML = "Hey can you figure out how to <a href='javascript:;' onclick='hidetext()'>hide</a> this text?";
	}
	
};


var firstButtonPressed = function() { //make a alert message pop up
	alert("You pressed my button and found that it makes an annoying popup!");
};

var secondButtonPressed = function() { //make a confirm dialoge pop up
	var answer = confirm("Please answer ok if you saw this message");
	
	if (answer === false){
		document.getElementById("test").innerHTML = "Why did you lie!! :D";
	}
};

var thirdButtonPressed = function() { //make a prompt pop up
	var message = prompt("What is your favorite Color?");
	
	if (message === "blue") {//determine if you said blue or another color
		document.getElementById("tbct").innerHTML = "My favorite color is blue too!";//say this if you like blue too
	} else if (message === "Blue") {
		document.getElementById("tbct").innerHTML = "My favorite color is blue too!";
	} else {
		document.getElementById("tbct").innerHTML = "Your Favorite color is " + message + " and my favorite color is blue";//say this if you do not like blue
	}
};

