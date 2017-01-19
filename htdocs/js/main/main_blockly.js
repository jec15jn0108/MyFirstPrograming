
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
}

var highlightPause = false;

function highlightBlock(id) {
  workspace.highlightBlock(id);
  highlightPause = true;
}

function parseCode() {
  // Generate JavaScript code and parse it.
  Blockly.JavaScript.STATEMENT_PREFIX = 'highlightBlock(%1);\n';
  Blockly.JavaScript.addReservedWords('highlightBlock');
  var code = Blockly.JavaScript.workspaceToCode(workspace);
  myInterpreter = new Interpreter(code, initApi);

  // alert('Ready to execute this code:\n\n' + code);
  document.getElementById('stepButton').disabled = '';
  highlightPause = false;
  workspace.highlightBlock(null);
}

function stepCode() {
  try {
    var ok = myInterpreter.step();
  } finally {
    if (!ok) {
      // Program complete, no more code to execute.
      document.getElementById('stepButton').disabled = 'disabled';
      workspace.highlightBlock(null);
      return;
    }
  }
  if (highlightPause) {
    // A block has been highlighted.  Pause execution here.
    highlightPause = false;
  } else {
    // Keep executing until a highlight statement is reached.
    stepCode();
  }
}

function runCode() {
  // var code = Blockly.JavaScript.workspaceToCode(workspace);
  // myInterpreter = new Interpreter(code, initApi);
  // myInterpreter.run();
  // workspace.highlightBlock(null);
  Blockly.JavaScript.addReservedWords('code');
  var code = Blockly.JavaScript.workspaceToCode(workspace);
  try {
    eval(code);
  } catch (e) {
    alert(e);
  }
  workspace.highlightBlock(null);
}

function showCode() {
  // workspace.highlightBlock(null);
  alert(getCode());
}

function getCode() {
  Blockly.JavaScript.STATEMENT_PREFIX = '';
  return Blockly.JavaScript.workspaceToCode(workspace);
}
