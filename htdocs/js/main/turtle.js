var turtle = {
  forword : function(){
    // alert("forword()");
    character.x += 32
    if (character.animeWaitCount > character.animeWaitMax) {
    	character.animeWaitCount = 0;
    	character.frame++;
    } else {
    	character.animeWaitCount++;
    }
  }
};
