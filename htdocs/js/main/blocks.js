
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
