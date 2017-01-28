
var blocklyArea = document.getElementById('blocklyArea');
var blocklyDiv = document.getElementById('blocklyDiv');
var workspace = Blockly.inject(blocklyDiv,
  { media: '/apis/google-blockly/media/',
    toolbox: document.getElementById('toolbox'),
    grid:
     {spacing: 20,
      length: 3,
      colour: '#ccc',
      snap: true},
    trashcan: true});
    //初期状態
    Blockly.Xml.domToWorkspace(document.getElementById('startBlocks'), workspace);


var onresize = function(e) {
  // Compute the absolute coordinates and dimensions of blocklyArea.
  var element = blocklyArea;
  var x = 0;
  var y = 0;
  do {
    x += element.offsetLeft;
    y += element.offsetTop;
    element = element.offsetParent;
  } while (element);
  // Position blocklyDiv over blocklyArea.
  blocklyDiv.style.left = x + 'px';
  blocklyDiv.style.top = y + 'px';
  blocklyDiv.style.width = blocklyArea.offsetWidth + 'px';
  blocklyDiv.style.height = blocklyArea.offsetHeight + 'px';
};
window.addEventListener('resize', onresize, false);
onresize();
Blockly.svgResize(workspace);

var myInterpreter = null;

function initApi(interpreter, scope) {
  // Add an API function for the alert() block.
  var wrapper = function(text) {
    text = text ? text.toString() : '';
    return interpreter.createPrimitive(alert(text));
  };
  interpreter.setProperty(scope, 'alert',
    interpreter.createNativeFunction(wrapper));

  // Add an API function for the prompt() block.
  var wrapper = function(text) {
    text = text ? text.toString() : '';
    return interpreter.createPrimitive(prompt(text));
  };
  interpreter.setProperty(scope, 'prompt',
    interpreter.createNativeFunction(wrapper));

  // Add an API function for highlighting blocks.
  var wrapper = function(id) {
    id = id ? id.toString() : '';
    return interpreter.createPrimitive(highlightBlock(id));
  };
  interpreter.setProperty(scope, 'highlightBlock',
    interpreter.createNativeFunction(wrapper));

  // Add TurtleAPI
  var wrapper = function() {
    return interpreter.createPrimitive(turtle.forword());
  };
  interpreter.setProperty(scope, 'forword',
    interpreter.createNativeFunction(wrapper));

  var wrapper = function() {
    return interpreter.createPrimitive(turtle.back());
  };
  interpreter.setProperty(scope, 'back',
    interpreter.createNativeFunction(wrapper));

  var wrapper = function() {
    return interpreter.createPrimitive(turtle.turnRight());
  };
  interpreter.setProperty(scope, 'turnRight',
    interpreter.createNativeFunction(wrapper));

  var wrapper = function() {
    return interpreter.createPrimitive(turtle.turnLeft());
  };
  interpreter.setProperty(scope, 'turnLeft',
    interpreter.createNativeFunction(wrapper));

  var wrapper = function() {
    return interpreter.createPrimitive(turtle.detect());
  };
  interpreter.setProperty(scope, 'detect',
    interpreter.createNativeFunction(wrapper));


  //console API
  var wrapper = function(text) {
    return interpreter.createPrimitive(print(text));
  };
  interpreter.setProperty(scope, 'print',
    interpreter.createNativeFunction(wrapper));
}

var highlightPause = false;

function highlightBlock(id) {
  workspace.highlightBlock(id);
  highlightPause = true;
}

var isRunning = false;
var isPause = false;

function parseCode() {
  reset();
  // Generate JavaScript code and parse it.
  Blockly.JavaScript.STATEMENT_PREFIX = 'highlightBlock(%1);\n';
  Blockly.JavaScript.addReservedWords('highlightBlock');
  var code = Blockly.JavaScript.workspaceToCode(workspace);
  myInterpreter = new Interpreter(code, initApi);

  // alert('Ready to execute this code:\n\n' + code);
  // document.getElementById('stepButton').disabled = '';
  isRunning = true;
  highlightPause = false;
  workspace.highlightBlock(null);
}

function stepCode(mode) {
  if (isRunning) {
    try {
      var ok = myInterpreter.step();
    } finally {
      if (!ok) {
        // Program complete, no more code to execute.
        // document.getElementById('stepButton').disabled = 'disabled';
        // $("#stepButton").prop("disabled", false);
        disableStep(false);
        // $("#runButton").prop("disabled", false);
        // $("#pauseButton").prop("disabled", true);
        changeRun("run");
        isRunning = false;
        workspace.highlightBlock(null);
        return false;
      }
    }
    if (highlightPause) {
      // A block has been highlighted.  Pause execution here.
      highlightPause = false;
    } else {
      // Keep executing until a highlight statement is reached.
      stepCode();
    }
    return true;
  } else {
    if (mode == "run") {
      return false;
    } else {
      parseCode();
    }
    // stepCode();
  }
}

function runCode() {
  if (!isRunning) {
    parseCode();
  }
  // $("#runButton").prop("disabled", true);
  // $("#runButton").attr("onclick", "pauseCode()");
  changeRun("pause");
  // $("#pauseButton").prop("disabled", false);
  // $("#stepButton").prop("disabled", true);
  disableStep(true);
  isPause = false;
  if (myInterpreter.step()) {
    var runTime = setInterval(function() {
      if (!stepCode("run") || isPause) {
        clearInterval(runTime);
      }
    }, 200);
  }
}

function stopCode() {
  // $("#stepButton").prop("disabled", false);
  myInterpreter = null;
  workspace.highlightBlock(null);
  isRunning = false;
  isPause = false;
  // $("#runButton").attr("onclick", "runCode()");
  changeRun("run");
  // $("#stepButton").prop("disabled", false);
  disableStep(false);
}

function pauseCode() {
  isPause = true;
  // $("#stepButton").prop("disabled", false);
  // $("#runButton").prop("disabled", false);
  // $("#runButton").attr("onclick", "runCode()");
  changeRun("run");
  disableStep(false);
}

function changeRun(mode) {
  if (mode == "run") {
    $("#runButton").attr("onclick", "runCode()");
    // $("#runButton").text("Run");
    $("#runButton > img").attr("src", "/src/ic_play_arrow_black_24dp.png");
  } else if (mode == "pause") {
    $("#runButton").attr("onclick", "pauseCode()");
    // $("#runButton").text("Pause");
    $("#runButton > img").attr("src", "/src/ic_pause_black_24dp.png");
  } else {
    //DoNothing
  }
}

function disableStep(mode) {
  if (mode == true) {
    $("#stepButton").prop("disabled", true);
    $("#stepButton > img").attr("src", "/src/ic_frame_forword_gray_24dp.png");
  } else {
    $("#stepButton").prop("disabled", false);
    $("#stepButton > img").attr("src", "/src/ic_frame_forword_black_24dp.png");
  }
}

function showCode() {
  // workspace.highlightBlock(null);
  alert(getCode());
}

function getCode() {
  Blockly.JavaScript.STATEMENT_PREFIX = '';
  return Blockly.JavaScript.workspaceToCode(workspace);
}
