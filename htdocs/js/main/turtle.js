function sleep(time) {
  const d1 = new Date();
  while (true) {
    const d2 = new Date();
    if (d2 - d1 > time) {
      break;
    }
  }
}


function restrictMove() {
  // 移動可能な範囲を制限
  var left   = 0;
  // var right  = window.innerWidth / 100 * 35 - character.width;
  var right = 512 - 32;
  var top    = 0;
  var bottom = 512 - 32;
  // var bottom = window.innerWidth / 100 * 35 - character.height;

  // X軸
  if (character.x < left) {
    character.x = left;
  } else if (character.x > right)	{
    character.x = right;
  }
  // Y軸
  if (character.y < top) {
    character.y = top;
  } else if (character.y > bottom) {
    character.y = bottom;
  }
}

function getForwordCoordinate() {
  var reversal;
  if (character.direction / 2 < 1) {
    reversal = 1;
  } else {
    reversal = -1;
  }

  var x = character.x;
  var y = character.y;
  if (character.direction % 2 == 0) {
    y = character.y - 32 * reversal;
  } else {
    x = character.x + 32 * reversal;
  }

  return [x, y];
}

function move(fb) {
  var reversal;
  if (character.direction / 2 < 1) {
    reversal = 1;
  } else {
    reversal = -1;
  }

  var vx = 0;
  var vy = 0;

  if (character.direction % 2 == 0) {
    vy -= 2 * reversal * fb;
  } else {
    vx += 2 * reversal * fb;
  }

  if (!map.hitTest(character.x + vx * 16, character.y + vy * 16)) {
    for (var i = 0; i < 16; i++) {
      if (!map.hitTest(character.x + vx, character.y + vy)) {
        character.x += vx;
        character.y += vy;
      }

      if (character.animeWaitCount > character.animeWaitMax) {
        character.animeWaitCount = 0;
        character.frame++;
        if (character.frame % 3 == 0) {
          character.frame = character.direction * 3;
        }
      } else {
        character.animeWaitCount++;
      }
    }
  }
  restrictMove();
}

function turn(rl) {
  character.direction += rl;
  character.direction = character.direction & 3;
  character.frame = character.direction * 3;
}


// TurtleAPI ===================================================================================-
var turtle = {
  forword : function() {
    move(1);
  },

  back : function() {
    move(-1);
  },

  turnRight : function() {
    turn(1);
  },

  turnLeft : function() {
    turn(-1);
  },

  detect : function() {
    var coord = getForwordCoordinate();
    return map.hitTest(coord[0], coord[1]);
  },

  isGoal : function() {
    return map.isGoal(character.x / 32, character.y / 32);
  },
};
