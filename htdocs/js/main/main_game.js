enchant();
var character;
window.onload = function() {
  var x = window.innerWidth / 100 * 35;
  var y = window.innerHeight / 100 * 35;
  // console.log(x + ":" + y);
  var game = new Core(x, x);


  var charaImage  = "/apis/enchant.js/images/chara3.png";
  var mapImage    = "/apis/enchant.js/images/map0.png";
  game.preload(charaImage, mapImage);

  game.onload = function(){
    // マップ====================================================
    var map = new Map(16, 16);
    map.image = game.assets[mapImage];
    var baseMap = [
      [  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0],
      [  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0],
      [  0,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  2,  0,  0],
      [  0,  2,  2,  2,  2,  2,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0],
      [  0,  2,  2,  2,  2,  2,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0],
      [  0,  2,  2,  2,  2,  2,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0],
      [  0,  2,  2,  2,  2,  2,  0,  0,  0,  0,  0,  0,  0,  0,  0,  0],
    ];
    map.loadData(baseMap);

    game.rootScene.addChild(map);
  //==========================================================

    // var x = window.innerWidth / 100 * 35;
    // var y = window.innerHeight / 100 * 35;
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
    character.scaleX = x / 12 / 32;
    character.scaleY = x / 12 / 32;
    // character.animeWaitMax = 3;
    // character.animeWaitCount = 0;

    game.rootScene.addChild(character);
    game.rootScene.addChild(sprite);

  };

  game.start();
  window.scrollTo(0, 0);
};
