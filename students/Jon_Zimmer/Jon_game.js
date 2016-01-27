function myGame() {
	var answer = prompt("Do you want to play a game? YES or NO");
	if (answer == 'YES') {
		var harpies = prompt("You're walking through the forest, minding your own business, and you run into harpies! Do you FIGHT them, PAY them, or RUN?").toUpperCase();
		switch (harpies) {
			case 'FIGHT':
				var strong = prompt("You are bold! Are you strong (YES or NO)?").toUpperCase();
				if (strong == "YES") {
					var smart = prompt("Are you smart?").toUpperCase();
				} 
					else {
						alert("Why the HECK did you challenge the harpies if you are weak? By the way, you were ripped to SHREADS!!!")
			break;
					}
			
						if (smart == 'YES') {
							var weapon = prompt("Do you have a sword of celestial bronze?").toUpperCase();
							} 
								else {
									alert("I knew it, you are an idiot. Well, you died.")
				break;
									}
										if (weapon == 'YES') {
											alert("Good job! You have killed the harpies and you continued you trip.")
											} 
					else {
					alert("If challenged the harpies without a weapon, you OBVIOUSLY LIED about being smart. You get sent to the Underworld")
					}
				break;
				
				
			case 'PAY':
				var gold = prompt("All right, you'll pay the harpies. Do you have any gold? (YES or NO)?").toUpperCase();
					if (gold == 'YES'){
						var dollars = prompt("How many gold coins do you have?").toUpperCase();
					}
					else{
						alert("How would you pay the harpies without any gold? You get killed")
					}
					if (dollars >= 3){
						alert("You pay the harpies and they leave you alone.")
					}
					else{
						alert("You should have thought to bring some more gold. You die.")
					}

					break;
				
				
			case 'RUN':
				var fast = prompt("Let's book it! Are you fast (YES or NO)?").toUpperCase();
				var headStart = prompt("Did you get a head start?").toUpperCase();
					if (fast=="YES" && headStart=="YES"){
								alert("You get away! Be a bit more careful next time")
							}
					else{
						alert("Aww shucks, the harpies catch you and kill you.")
					}
				break;
				
			default:
				alert("I didn't understand your choice. Hit Run and try again, this time picking FIGHT, PAY, or RUN!");
		}
	}
	if (answer == 'NO')
		alert("Okay, have a nice day!");
}