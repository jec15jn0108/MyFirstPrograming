
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
