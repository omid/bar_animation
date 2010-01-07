window.addEvent('domready', function(){
	
	var myDrag = new Drag($$('div.handle')[0]);
	
	document.addEvent('keydown', function(event){
		
		if(event.shift == true)
			step = 2;
		else
			step = 1;
			
	    if (event.key == "left"){
			$$('div.handle')[0].setStyle('left', $$('div.handle')[0].getStyle('left').toInt() - step);
		}
	    if (event.key == "right"){
			$$('div.handle')[0].setStyle('left', $$('div.handle')[0].getStyle('left').toInt() + step);
		}
		
	});
	
});