<!-- tic tac toe v1.0 -->
<!-- February 2, 2016 -->
<!DOCTYPE html>
<html>

  <head>
    <title>Tic Tac Toe</title>
    <link href="css_files/ticTacToe.css" rel="stylesheet">
    <script language="javascript" type="text/javascript" src="javascript_files/ticTacToe.js"></script>
  </head>

  <body onload="requireOnce();init();">
    
    <center>
    <div class="canvasPositioningFrame">
      <canvas id='ticTacToeCanvas' height='500px' width='600px'>If you see this you must still be in 2005!</canvas>
    </div>

    <div class="controlFrame">
      
      <div class="player1Box">
        <p class="player1Name">
          Player 1
        </p>
        <p id="player1Score">
          0 Wins
        </p>
      </div>
      
      
        <div class="title">
          <h2>
            Tic Tac Toe
          </h2>
          <p id="playerTurn">
            Player Turn<br><<<<
          </p>
          <button onclick="resetGame()">
            Reset Board
          </button>
        </div>
   
      
      <div class="player2Box">
        <p class="player2Name">
          Player 2
        </p>
        <p id="player2Score">
          0 Wins
        </p>
      </div>
      
    </div>
  </center>
    
</body>
</html>