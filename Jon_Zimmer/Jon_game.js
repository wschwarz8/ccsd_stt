alert("Hello! This page belongs to Jonathan Zimmer!");
prompt("Do you want to play a game? YES or NO");
	if(Yes)
			var harpies = prompt("You're walking through the forest, minding your own business, and you run into harpies! Do you FIGHT them, PAY them, or RUN?").toUpperCase();

switch(harpies) {
  case 'FIGHT':
    var strong = prompt("You are bole! Are you strong (YES or NO)?").toUpperCase();
    var smart = prompt("Are you smart?").toUpperCase();
	var weapon = prompt("Do you have a sword of celestial bronze?").toUpperCase();
    if(strong === 'YES' || smart === 'YES' || weapon=== 'YES') {
      console.log("You only need two of the three! You defeat the harpies--nice work!");
    } else {
      console.log("You're not strong, smart, nor have a weapon? Well, if you at least were smart, you probably wouldn't have tried to fight harpies. You are ripped to shreds!");
    }
    break;
  case 'PAY':
    var money = prompt("All right, we'll pay the harpies. Do you have any money (YES or NO)?").toUpperCase();
    var dollars = prompt("Is your money made of gold?").toUpperCase();
    if(money === 'YES' && dollars === 'YES') {
      console.log("Great! You pay the harpies and they let you live.");
    } else {
      console.log("Dang! The harpies only wants gold coins. You get killed!");
    }
    break;
  case 'RUN':
    var fast = prompt("Let's book it! Are you fast (YES or NO)?").toUpperCase();
    var headStart = prompt("Did you get a head start?").toUpperCase();
    if(fast === 'YES' || headStart === 'YES') {
      console.log("You got away--barely! You live to stroll through the forest another day.");
    } else {
      console.log("You're not fast and you didn't get a head start? You never had a chance! The harpies kill you.");
    }
    break;
  default:
    console.log("I didn't understand your choice. Hit Run and try again, this time picking FIGHT, PAY, or RUN!");
}
if("NO")
	console.log("Okay, have a nice day!");