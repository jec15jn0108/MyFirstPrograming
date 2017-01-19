enchant();

window.onload = function() {
  var x = window.innerWidth / 100 * 35;
  var y = window.innerHeight / 100 * 35;
  console.log(x + ":" + y);
  var game = new Core(x, x);

  var charaImage = "/apis/enchant.js/images/chara1.png";

  game.preload(charaImage);

  game.onload = function(){
    var x = window.innerWidth / 100 * 35;
    var y = window.innerHeight / 100 * 35;
    console.log(x + ":" + y);
    var sprite = new Sprite(x, x);
    sprite.x = 0;
    sprite.y = 0;
    var surface = new Surface(x, x);
    sprite.image = surface;
    var ctx = surface.context;
    ctx.strokeStyle = "rgb(0, 0, 0)";
    ctx.strokeRect(10, 10, x - 20 , x - 20);
    // ctx.strokeRect(1, 500, 500, 80);
    // ctx.strokeRect(520, 1, 700, 780);
    ctx.stroke();


    var character = new Sprite(32, 32);
    character.image = game.assets[charaImage];
    character.x = 10;
    character.y = 10;


    // var block = new Entity();
    // block._element = document.createElement('button');
    // block._element.setAttribute("class", "drag-and-drop");
    // block._element.innerHTML = "aaa";
    // block.width = 300;




    // game.rootScene.addChild(block);
    game.rootScene.addChild(character);
    game.rootScene.addChild(sprite);

  };

  game.start();
  window.scrollTo(0, 0);
};
