$(document).ready(function() {
	$('.product_zoom').hover(function() {
		var html = $(this).html();
		var w = $(this).width()+20;
		//$(this).hide();
		var p = $(this).position();
		var top = p.top - 10;
		var left = p.left - 20;
		
		$(this).prepend("<div class='zoom' style='top:"+top+";left:"+left+";'>"+html+"</div>");
		//$(this).hide();
		var t = $('.zoom').find('table');
		if (t.length == 0){
			$('.zoom').css('left',p.left);

			$('.zoom').css('width',w);
		}
		else {
			console.log('sdfa');
			t[0].style.width = w+'px';
		}
		
		var images = $('.zoom').find("img");
	//	images[0].width = images[0].width * 2;
	//	images[0].height = images[0].height * 2;
		
		$.each(images, function(key, i) {
			i.width = i.width * 1.5;
			i.height = i.height * 1.5;
			
		}); 
		
	}, function() {
		//$(this).show();
		$('.zoom').remove();
	});
});