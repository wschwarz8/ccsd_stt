function init() {

  //grid size of the game
  gridSize = 50;

  lvl1();

  //frame variables
  width = 1050;
  height = 600;

  //-------game variables--------
  //game mode
  play = "False";

  //pacman mouth angles for start
  topMouthAngle = 1.7;
  bottomMouthAngle = 2.0;

  //pacman eye heigth
  eyePosition = 12;

  //needed to prevent errors in movement
  pacCheck = "False";
  check = "False";
  moveComplete = "True";


  //debug variables
  debug = "False"; //make this true for trouble shooting

  //timing variables
  flashCycle = 0;

  //background gradient variables
  gradx1 = 0;
  gradx2 = 0;
  gradx3 = 1050;
  gradx4 = 0;

  //color pallet for easy changing
  color = ["Red", "Orange", "Yellow", "Green", "Blue", "Purple"];
  colorCycle = 0;
  currentColor = color[colorCycle];

  //set up the canvas
  pacManCanvas = document.getElementById('pacManCanvas');
  canvas = pacManCanvas.getContext('2d');

  //create any eventlisteners
  window.addEventListener("keydown", keydownfunc);

  //start the gameloop
  startStuff();
}

function startStuff() {
  timer = setInterval(gameLoop, 70);
}


function gameLoop() {

  //move pacman
  movePacman();

  //move ghost
  moveGhost();

  //draw
  draw();
}


//process key events
function keydownfunc() {

  //get key code
  var x = event.keyCode;

  switch (x) {
    case 38: //up arrow

      if (play == "True") {

        direction = "up";

      }
      break;
    case 87: //w key

      if (play == "True") {

        direction = "up";

      }
      break;
    case 40: //down arrow

      if (play == "True") {

        direction = "down";

      }
      break;
    case 83: //s key

      if (play == "True") {

        direction = "down";

      }
      break;
    case 39: //right arrow

      if (play == "True") {

        direction = "right";

      }
      break;
    case 68: //d key

      if (play == "True") {

        direction = "right";

      }
      break;
    case 37: //left arrow

      if (play == "True") {

        direction = "left";

      }
      break;
    case 65: //a key

      if (play == "True") {

        direction = "left";

      }
      break;
    case 13: //enter key

      if (play == "True") {
        play = "False";
      } else {
        play = "True";
      }

      break;
    default:
      //do nothing
  }
}


//calculate the move for pacman
function movePacman() {

  if (play == "True") {

    //move the pacman
    if (moveComplete == "True") {
      switch (direction) {
        case "up":

          checkMove();

          if (pacCheck == "False") {
            break;
          }

          //calculate new pack man position
          newPacMany = pacMany - gridSize;
          newPacManx = pacManx;

          pacMany = pacMany - 10;
          lastTrueDirection = "up";

          moveComplete = "False";

          break;
        case "down":

          checkMove();

          if (pacCheck == "False") {
            break;
          }

          //calculate new pack man position
          newPacMany = pacMany + gridSize;
          newPacManx = pacManx;

          pacMany = pacMany + 10;
          lastTrueDirection = "down";

          moveComplete = "False";

          break;
        case "left":

          checkMove();

          if (pacCheck == "False") {
            break;
          }

          //calculate new pack man position
          newPacManx = pacManx - gridSize;
          newPacMany = pacMany;

          pacManx = pacManx - 10;
          lastTrueDirection = "left";

          moveComplete = "False";

          break;
        case "right":

          checkMove();

          if (pacCheck == "False") {
            break;
          }

          //calculate new pack man position
          newPacManx = pacManx + gridSize;
          newPacMany = pacMany;

          pacManx = pacManx + 10;
          lastTrueDirection = "right";

          moveComplete = "False";

          break;
        default:
          //this shouldnt happen
      }
    } else if (moveComplete == "False") {

      if (pacManx == newPacManx && pacMany == newPacMany) {
        moveComplete = "True";
        movePacman();
      } else {
        switch (lastTrueDirection) {
          case "up":

            pacMany = pacMany - 10;

            break;
          case "down":

            pacMany = pacMany + 10;
            break;
          case "left":

            pacManx = pacManx - 10;

            break;
          case "right":

            pacManx = pacManx + 10;


          default:
            //this shouldnt happen
        }
      }
    }


  }
}

//make sure the move pacman is going to do is valid.
function checkMove() {

  //find coordinate position
  xGridPos = (pacManx / gridSize);
  yGridPos = (pacMany / gridSize);

  //check collision
  switch (direction) {
    case "up":

      if (levelRow[yGridPos - 1][xGridPos] == 1) {
        pacCheck = "False";
      } else {
        pacCheck = "True";
      }

      break;
    case "down":

      if (levelRow[yGridPos + 1][xGridPos] == 1) {
        pacCheck = "False";
      } else {
        pacCheck = "True";
      }

      break;
    case "left":

      if (levelRow[yGridPos][xGridPos - 1] == 1) {
        pacCheck = "False";
      } else {
        pacCheck = "True";
      }

      break;
    case "right":


      if (levelRow[yGridPos][xGridPos + 1] == 1) {
        pacCheck = "False";
      } else {
        pacCheck = "True";
      }

    default:
      //this shouldnt happen
  }


  //check food/powerup
  if (levelRow[yGridPos][xGridPos] == 0 || levelRow[yGridPos][xGridPos] == 3) {
    levelRow[yGridPos][xGridPos] = 10;
    score = score + 100;

  } else if (ghostX == pacManx && ghostY == pacMany) {
    play = "ghost";
    console.log("The Ghost win");

  }

  if (score == maxScore) {
    play = "pac";
    console.log("The pacman wins");

  }

}



function moveGhost() { //AI M3

  if (play == "True") {
    // locate the ghost and pacman

    for (i = 0; i < ghostCount; i++) {

      if (ghostMoveComplete[i] == "True") {


        pacxGridPos = (pacManx / gridSize);
        pacyGridPos = (pacMany / gridSize);

        ghostxGridPos = [];
        ghostyGridPos = [];

        ghostxGridPos[i] = (ghostX[i] / gridSize);
        ghostyGridPos[i] = (ghostY[i] / gridSize);

        //assign some varibles
        leftBox = [];
        rightBox = [];
        topBox = [];
        bottomBox = [];

        leftBox[i] = levelRow[ghostyGridPos[i]][ghostxGridPos[i] - 1];
        rightBox[i] = levelRow[ghostyGridPos[i]][ghostxGridPos[i] + 1];
        topBox[i] = levelRow[ghostyGridPos[i] - 1][ghostxGridPos[i]];
        bottomBox[i] = levelRow[ghostyGridPos[i] + 1][ghostxGridPos[i]];

        //find the perfered direction///

        ghostTurnDirection1 = [];
        ghostTurnDirection2 = [];

        //deterimine if its left or right
        if (ghostxGridPos[i] > pacxGridPos) {

          ghostTurnDirection1[i] = "left";

        } else if (ghostxGridPos[i] < pacxGridPos) {

          ghostTurnDirection1[i] = "right";

        } else {
          ghostTurnDirection1[i] = "niether";
        }

        //determine if its up or down
        if (ghostyGridPos[i] > pacyGridPos) {

          ghostTurnDirection2[i] = "up";

        } else if (ghostyGridPos[i] < pacyGridPos) {

          ghostTurnDirection2[i] = "down";

        } else {
          ghostTurnDirection2[i] = "niether";
        }



        //decide the direction
        switch (ghostLastTrueDirection[i]) {
          case "up": //ghost is currently going up so it can turn either left, right or stay the same

            //check what direction is perfered ---- their will be two
            if (ghostTurnDirection1[i] == "left") {

              if (leftBox[i] == 1) { //check if the direction is eliggible

                if (topBox[i] == 1) {
                  ghostsDirection[i] = "right";
                }

                break; //stop checks if you get in here

              } else { //no obsticle then turn

                ghostsDirection[i] = "left";
              }

            } else if (ghostTurnDirection1[i] == "right") {

              if (rightBox[i] == 1) { //check if the direction is eliggible

                if (topBox[i] == 1) {
                  ghostsDirection[i] = "left";
                }

                break; //stop checks if you get in here

              } else { //no obsticle then turn

                ghostsDirection[i] = "right";
              }

            } else if (ghostTurnDirection1[i] == "niether") {
              //check if the next direction is valid
              if (topBox[i] == 1) {


                if (rightBox[i] == 1) {
                  ghostsDirection[i] = "left";
                } else if (leftBox[i] == 1) {
                  ghostsDirection[i] = "right";
                }


              } //end of continue check

              break; //dont change the direction
            }

            break;
          case "down":


            //check what direction is perfered ---- their will be two
            if (ghostTurnDirection1[i] == "left") {

              if (leftBox[i] == 1) { //check if the direction is eliggible

                if (bottomBox[i] == 1) {
                  ghostsDirection[i] = "right";
                }

                break; //stop checks if you get in here

              } else { //no obsticle then turn

                ghostsDirection[i] = "left";
              }

            } else if (ghostTurnDirection1[i] == "right") {

              if (rightBox[i] == 1) { //check if the direction is eliggible

                if (bottomBox[i] == 1) {
                  ghostsDirection[i] = "left";
                }

                break; //stop checks if you get in here

              } else { //no obsticle then turn

                ghostsDirection[i] = "right";
              }

            } else if (ghostTurnDirection1[i] == "niether") {

              //check if the next direction is valid
              if (bottomBox[i] == 1) {

                if (rightBox[i] == 1) {
                  ghostsDirection[i] = "left";
                } else if (leftBox[i] == 1) {
                  ghostsDirection[i] = "right";
                }


              } //end of continue check

              break; //dont change the direction
            }


            break;
          case "left":


            //check what direction is perfered ---- their will be two
            if (ghostTurnDirection2[i] == "up") {

              if (topBox[i] == 1) { //check if the direction is eliggible

                if (leftBox[i] == 1) {
                  ghostsDirection[i] = "down";
                }

                break; //stop checks if you get in here

              } else { //no obsticle then turn

                ghostsDirection[i] = "up";
              }

            } else if (ghostTurnDirection2[i] == "down") {

              if (bottomBox[i] == 1) { //check if the direction is eligible

                if (leftBox[i] == 1) {
                  ghostsDirection[i] = "right";
                }

                break; //stop checks if you get in here

              } else { //no obsticle then turn

                ghostsDirection[i] = "down";
              }

            }
            if (ghostTurnDirection2[i] == "niether") {

              //check if the next direction is valid
              if (leftBox[i] == 1) {


                if (topBox[i] == 1) {
                  ghostsDirection[i] = "down";
                } else if (bottomBox[i] == 1) {
                  ghostsDirection[i] = "up";
                }


              } //end of continue check

              break; //dont change the direction
            }


            break;
          case "right":

            //check what direction is perfered ---- their will be two
            if (ghostTurnDirection2[i] == "up") {

              if (topBox[i] == 1) { //check if the direction is eligible

                if (rightBox[i] == 1) {
                  ghostsDirection[i] = "down";
                }

                break; //stop checks if you get in here

              } else { //no obsticle then turn

                ghostsDirection[i] = "up";
              }

            } else if (ghostTurnDirection2[i] == "down") {

              if (bottomBox[i] == 1) { //check if the direction is eliggible

                if (rightBox[i] == 1) {
                  ghostsDirection[i] = "right";
                }

                break; //stop checks if you get in here

              } else { //no obsticle then turn

                ghostsDirection[i] = "down";
              }

            }
            if (ghostTurnDirection2[i] == "niether") {

              //check if the next direction is valid
              if (rightBox[i] == 1) {


                if (topBox[i] == 1) {
                  ghostsDirection[i] = "down";
                } else if (bottomBox[i] == 1) {
                  ghostsDirection[i] = "up";
                }


              } //end of continue check

              break; //dont change the direction
            }

            break;

        }

      }

    //move the ghost

    if (ghostMoveComplete[i] == "True") {

      //determine the current directine
      switch (ghostsDirection[i]) {
        case "up":


          //calculate new pack man position
          newGhosty[i] = ghostY[i] - gridSize;
          newGhostx[i] = ghostX[i];

          ghostY[i] = ghostY[i] - ghostSpeed[i];

          ghostLastTrueDirection[i] = "up";

          ghostMoveComplete[i] = "False";

          break;
        case "down":


          //calculate new pack man position
          newGhosty[i] = ghostY[i] + gridSize;
          newGhostx[i] = ghostX[i];

          ghostY[i] = ghostY[i] + ghostSpeed[i];

          ghostLastTrueDirection[i] = "down";

          ghostMoveComplete[i] = "False";

          break;
        case "left":


          //calculate new pack man position
          newGhostx[i] = ghostX[i] - gridSize;
          newGhosty[i] = ghostY[i];

          ghostX[i] = ghostX[i] - ghostSpeed[i];

          ghostLastTrueDirection[i] = "left";

          ghostMoveComplete[i] = "False";

          break;
        case "right":

          //calculate new pack man position
          newGhostx[i] = ghostX[i] + gridSize;
          newGhosty[i] = ghostY[i];

          ghostX[i] = ghostX[i] + ghostSpeed[i];

          ghostLastTrueDirection[i] = "right";

          ghostMoveComplete[i] = "False";

          break;
        default:

      }

    } else if (ghostMoveComplete[i] == "False") {

      if (ghostX[i] == newGhostx[i] && ghostY[i] == newGhosty[i]) {



        ghostMoveComplete[i] = "True";
        moveGhost();

      } else {

        switch (ghostLastTrueDirection[i]) {
          case "up":

            ghostY[i] = ghostY[i] - ghostSpeed[i];

            break;
          case "down":

            ghostY[i] = ghostY[i] + ghostSpeed[i];
            break;
          case "left":

            ghostX[i] = ghostX[i] - ghostSpeed[i];

            break;
          case "right":

            ghostX[i] = ghostX[i] + ghostSpeed[i];


          default:
            //this shouldnt happen
        } //end of switch

      } //endif

    } //endif

    }//end of for
    
  } //endif for play

} //end of function