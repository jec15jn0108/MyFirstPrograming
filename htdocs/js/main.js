enchant();

window.onload = function() {
  var game = new Core(520, 592);

  var charaImage = "/js/enchant.js/images/chara1.png";

  game.preload(charaImage);

  game.onload = function(){

    var sprite = new Sprite(2000, 1000);
    sprite.x = 10;
    sprite.y = 10;
    var surface = new Surface(2000, 1000);
    sprite.image = surface;
    var ctx = surface.context;
    ctx.strokeStyle = "rgb(0, 0, 0)";
    ctx.strokeRect(1, 1, 500, 780);
    ctx.strokeRect(1, 500, 500, 80);
    ctx.strokeRect(520, 1, 700, 780);
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
