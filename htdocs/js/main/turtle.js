function restrictMove() {
  // 移動可能な範囲を制限
  var left   = 0;
  var right  = window.innerWidth / 100 * 35 - character.width;
  var top    = 0;
  var bottom = window.innerWidth / 100 * 35 - character.height;

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

var turtle = {
  forword : function(){
    // alert("forword()");
    var x = window.innerWidth / 100 * 35;
    character.x += x / 12;
    if (character.animeWaitCount > character.animeWaitMax) {
    	character.animeWaitCount = 0;
    	character.frame++;
    } else {
    	character.animeWaitCount++;
    }
    restrictMove();
  },

  back : function(){
    // alert("forword()");
    var x = window.innerWidth / 100 * 35;
    character.x -= x / 12;
    if (character.animeWaitCount > character.animeWaitMax) {
    	character.animeWaitCount = 0;
    	character.frame++;
    } else {
    	character.animeWaitCount++;
    }
    restrictMove();
  }
};
