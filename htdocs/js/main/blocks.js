
Blockly.Blocks['forword'] = {
  init: function() {
    this.appendDummyInput()
        .appendField("前に進む");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(230);
    this.setTooltip('');
    this.setHelpUrl('');
  }
};

Blockly.JavaScript['forword'] = function(block) {
  // TODO: Assemble JavaScript into code variable.
  var code = 'forword();\n';
  return code;
};

Blockly.Blocks['back'] = {
  init: function() {
    this.appendDummyInput()
        .appendField("後ろに戻る");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(230);
    this.setTooltip('');
    this.setHelpUrl('');
  }
};

Blockly.JavaScript['back'] = function(block) {
  // TODO: Assemble JavaScript into code variable.
  var code = 'back();\n';
  return code;
};



Blockly.Blocks['turnRight'] = {
  init: function() {
    this.appendDummyInput()
        .appendField("右を向く");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(230);
    this.setTooltip('');
    this.setHelpUrl('');
  }
};

Blockly.JavaScript['turnRight'] = function(block) {
  // TODO: Assemble JavaScript into code variable.
  var code = 'turnRight();\n';
  return code;
};

Blockly.Blocks['turnLeft'] = {
  init: function() {
    this.appendDummyInput()
        .appendField("左を向く");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(230);
    this.setTooltip('');
    this.setHelpUrl('');
  }
};

Blockly.JavaScript['turnLeft'] = function(block) {
  // TODO: Assemble JavaScript into code variable.
  var code = 'turnLeft();\n';
  return code;
};


Blockly.Blocks['detect'] = {
  init: function() {
    this.appendDummyInput()
        .appendField("前に進めるか");
    this.setOutput(true, "Boolean");
    this.setColour(210);
    this.setTooltip('');
    this.setHelpUrl('');
  }
};

Blockly.JavaScript['detect'] = function(block) {
  // TODO: Assemble JavaScript into code variable.
  var order = Blockly.JavaScript.ORDER_LOGICAL_NOT;
  var argument0 = Blockly.JavaScript.valueToCode(block, 'BOOL', order) ||
      '';
  var code = 'detect()' + argument0;
  return [code, order];
};


Blockly.Blocks['print'] = {
  /**
   * Block for print statement.
   * @this Blockly.Block
   */
  init: function() {
    this.jsonInit({
      "message0": Blockly.Msg.TEXT_PRINT_TITLE,
      "args0": [
        {
          "type": "input_value",
          "name": "TEXT"
        }
      ],
      "previousStatement": null,
      "nextStatement": null,
      "colour": Blockly.Blocks.texts.HUE,
      "tooltip": Blockly.Msg.TEXT_PRINT_TOOLTIP,
      "helpUrl": Blockly.Msg.TEXT_PRINT_HELPURL
    });
  }
};

Blockly.JavaScript['print'] = function(block) {
  var msg = Blockly.JavaScript.valueToCode(block, 'TEXT',
      Blockly.JavaScript.ORDER_NONE) || '\'\'';
  return 'print(' + msg + ');\n';
};
