enchant();
var character;
var map;
window.onload = function() {
  var x = window.innerWidth / 100 * 35;
  var y = window.innerHeight / 100 * 55;
  var side = ( x > y ) ? y : x;
  // console.log(x + ":" + y);
  var game = new Core(512, 512);

  game.fps = 15;


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

    //=マップ読み込み=================================================
    //characterの初期設定

      eval($.cookie("map0") + $.cookie("map1") + $.cookie("map2"));
      reset();

    //===============================================================

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

    //ゴール判定
    // game.rootScene.addEventListener(enchant.Event.ENTER_FRAME, function() {
    //   if (map.isGoal(character.x / 32, character.y / 32)) {
    //     window.alert("gooooooal");
    //     reset();
    //   }
    //   // console.log("char:" + character.x + "," + character.y);
    //   // console.log("goal:" + map.goal.x + "," + map.goal.y);
    // });

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


function showGoalWindow() {
  print("Code:");
  print(getCode());
  var mapName = $("#stageName").val();

  if (mapName == "") {
    window.alert("ステージ名を設定してもう一度実行して下さい");
    $("#stageName").val("");
    $("#stageName").focus();
    return false;
  }

  var ret = window.confirm("実行したコードを模範解答に設定しますか？\n\nステージ名: " + mapName + "\nブロックの数: " + blockNum + "\n\n" + getCode() + "\n");
  if (ret) {
    var jsStr = $.cookie("map0") + $.cookie("map1") + $.cookie("map2");
    var xmlStr = Blockly.Xml.workspaceToDom(workspace);
    xmlStr.setAttribute('id', 'workspaceBlocks');
    xmlStr.setAttribute('style', 'display:none');
    xmlStr = xmlStr.outerHTML;

    // console.log(jsStr);
    // console.log(xmlStr);

    $.ajax({
      url: "/php/save_map.php",
      type: "POST",
      data: {
        teamId: $.cookie("team"),
        mapName: $("#stageName").val(),
        mapData: jsStr,
        answer: xmlStr,
        blockNum: blockNum,
        genre: $("#genre").val(),
      }
    })
    .done(function (data) {
      console.log(data);
      if (data == "false") {
        window.alert("ステージ名: " + $("#stageName").val() + " は既に存在しています。")
      } else {
        window.location.href = "/main";
      }
    })
    .fail(function () {
      console.err("error");
    });

    // var stageJson = {
    //   map: jsStr,
    //   answer: xmlStr
    // };
    //
    // console.log(stageJson);

  } else {

  }
}
