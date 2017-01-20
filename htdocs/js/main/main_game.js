enchant();
var character;
window.onload = function() {
  var x = window.innerWidth / 100 * 35;
  var y = window.innerHeight / 100 * 35;
  // console.log(x + ":" + y);
  var game = new Core(x, x);

  var charaImage = "/apis/enchant.js/images/chara3.png";
  game.preload(charaImage);


  game.onload = function(){
    var x = window.innerWidth / 100 * 35;
    var y = window.innerHeight / 100 * 35;
    // console.log(x + ":" + y);
    var sprite = new Sprite(x, x);
    sprite.x = 0;
    sprite.y = 0;
    var surface = new Surface(x, x);
    sprite.image = surface;
    var ctx = surface.context;
    ctx.strokeStyle = "rgb(0, 0, 0)";
    ctx.strokeRect(0, 0, x , x);
    ctx.stroke();


    character = new Sprite(32, 32);
    character.image = game.assets[charaImage];
    character.x = 0;
    character.y = 0;
    character.animeWaitMax = 3;
    character.animeWaitCount = 0;	

    game.rootScene.addChild(character);
    game.rootScene.addChild(sprite);

  };

  game.start();
  window.scrollTo(0, 0);
};
