enchant();
var character;
var map;
window.onload = function() {
  var x = window.innerWidth / 100 * 35;
  var y = window.innerHeight / 100 * 55;
  var side = ( x > y ) ? y : x;
  // console.log(x + ":" + y);
  var game = new Core(512, 512);


  var charaImage  = "/src/character.png";
  var mapImage    = "/src/map0.gif";
  game.preload(charaImage, mapImage);

  game.onload = function(){
    // マップ====================================================
    map = new Map(32, 32);
    map.image = game.assets[mapImage];
    map.isGoal = function(x, y) {
      if (x == map.goal.x && y == map.goal.y) {
        return true;
      }
      return false;
    }

    //==========================================================

    character = new Sprite(32, 32);
    character.image = game.assets[charaImage];
    character.animeWaitMax = 3;
    character.animeWaitCount = 0;

    // //characterの初期設定
    // character.startDirection = 1;
    // character.startX = 3 * 32;
    // character.startY = 2 * 32;

    //=マップ読み込み=================================================
      $.ajax({
        url: "/php/get_map.php",
        type: "POST",
        dataType: "text",
        data: {
          teamId: $.cookie("team"),
          genre: $.cookie("stage_genre"),
          number: $.cookie("stage_number"),
        }
      })
      .done(function (data) {
        console.log(data.charAt(0));
        if (data.charAt(0) != "<") {
          eval(data);
          $("h1").text(map.name);
          $("title").text("M.F.P. " + map.name);
          reset();
          setNowStage();
        } else if ($.cookie("is_teacher") == "true") {
          window.alert("右上の[ステージ作成]ボタンを押し、ステージを作成して下さい。")
        } else {
          window.alert("ステージがありません");
        }
      })
      .fail(function () {
        console.err("error");
      });
    //===============================================================
    reset();
    game.rootScene.addChild(map);
    game.rootScene.addChild(character);
    // game.rootScene.addChild(sprite);

    game.scale = side / 512;
    $("#enchant-stage").css("margin-left", ( x > side ) ? (x - y) / 2 : 10);

    $("#buttons").css("margin-top", side + 10);
    $("#buttons").css("margin-left", ( x > side ) ? (x - y) / 2 : 10);
    $("#buttons").css("width", side);

    $("#console").css("margin-top", side + 80);
    $("#console").css("margin-left", ( x > side ) ? (x - y) / 2 : 10);
    $("#console").css("width", side);
    $("#console").css("height", window.innerHeight - side - 180);

    //カーソルキーがenchant.jsに拉致されてるのでエディターのカーソル移動をイベントで処理
    game.rootScene.addEventListener(enchant.Event.DOWN_BUTTON_DOWN, function() {
      var cursor = editor.selection.getCursor();
      editor.gotoLine(cursor.row + 2, cursor.column, true);
    });
    game.rootScene.addEventListener(enchant.Event.UP_BUTTON_DOWN, function() {
      var cursor = editor.selection.getCursor();
      editor.gotoLine(cursor.row , cursor.column, true);
    });
    game.rootScene.addEventListener(enchant.Event.RIGHT_BUTTON_DOWN, function() {
      var cursor = editor.selection.getCursor();
      editor.gotoLine(cursor.row + 1 , cursor.column + 1, true);
    });
    game.rootScene.addEventListener(enchant.Event.LEFT_BUTTON_DOWN, function() {
      var cursor = editor.selection.getCursor();
      editor.gotoLine(cursor.row + 1 , cursor.column - 1, true);
    });



  };
  game.start();
  window.scrollTo(0, 0);
};

function reset() {
  stopCode();
  character.x = character.startX;
  character.y = character.startY;
  character.direction = character.startDirection;
  character.frame = character.direction * 3;

  $("#console").val("");
}
