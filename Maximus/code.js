//any variables that need iniatiated at start place here
var testnumber1 = 1;

var startsurvey = function() {
	var decision1 = confirm("Would you like to take a Survey");

	if (decision1 === true) {
		var answer1 = prompt("What is your favorite Color?");
		var answer2 = prompt("What is your favorite animal?");
		var answer3 = prompt("What is your favorite food?");
		var answer4 = prompt("What is your favorite computer language?");
		var answer5 = prompt("What is your favorite sport to watch?");

		document.getElementById("firstanswer").innerHTML = answer1;
		document.getElementById("secondanswer").innerHTML = answer2;
		document.getElementById("thirdanswer").innerHTML = answer3;
		document.getElementById("fourthanswer").innerHTML = answer4;
		document.getElementById("fifthanswer").innerHTML = answer5;
	} else {

		document.getElementById("firstanswer").innerHTML = "null";
		document.getElementById("secondanswer").innerHTML = "null";
		document.getElementById("thirdanswer").innerHTML = "null";
		document.getElementById("fourthanswer").innerHTML = "null";
		document.getElementById("fifthanswer").innerHTML = "null";
		document.getElementById("surveytitle").innerHTML = "Survey Results(Didn't take)";
	}

};



var hidetext = function() { //hide texxt function
	if (testnumber1 === 1) {
		testnumber1 = 2;
		document.getElementById("hidetexts").innerHTML = "<a href='javascript:;' onclick='hidetext()'>Show</a>";
	} else {
		testnumber1 = 1;
		document.getElementById("hidetexts").innerHTML = "Hey can you figure out how to <a href='javascript:;' onclick='hidetext()'>hide</a> this text?";
	}

};


var firstButtonPressed = function() { //make a alert message pop up
	alert("You pressed my button and found that it makes an annoying popup!");
};

var secondButtonPressed = function() { //make a confirm dialoge pop up
	var answer = confirm("Please answer ok if you saw this message");

	if (answer === false) {
		document.getElementById("test").innerHTML = "Why did you lie!! :D";
	}
};

var thirdButtonPressed = function() { //make a prompt pop up
	var message = prompt("What is your favorite Color?");

	if (message === "blue") { //determine if you said blue or another color
		message = "My favorite color is blue too!"; //say this if you like blue too
	} else if (message === "Blue") {
		message = "My favorite color is blue too!";
	} else {
		message = "Your Favorite color is " + message + " and my favorite color is blue"; //say this if you do not like blue
	}
	
	document.getElementById("btn3a").innerHTML = message;
};