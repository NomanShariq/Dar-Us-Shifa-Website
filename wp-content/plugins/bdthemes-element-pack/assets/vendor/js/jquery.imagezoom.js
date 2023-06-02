/*
*	ImageZoom - Responsive jQuery Image Zoom Pluin
*   version: 1.1.0
*	by hkeyjun
*   http://codecanyon.net/user/hkeyjun	
*/
;(function( $, window, undefined ) {
	$.ImageZoom = function(el,options){
		var base = this;
		base.$el = $(el);
		
		base.$el.data('imagezoom',base);
		
		base.init = function(options){
			base.options = $.extend({},$.ImageZoom.defaults,options);
			base.$viewer = $('<div class="zm-viewer '+base.options.zoomViewerClass+'"></div>').appendTo('body');
			base.$handler = $('<div class="zm-handler'+base.options.zoomHandlerClass+'"></div>').appendTo('body');
			base.isBigImageReady = -1;
			base.$largeImg = null;
			base.isActive = false;
			base.$handlerArea = null;
			base.isWebkit = /chrome/.test(navigator.userAgent.toLowerCase()) || /safari/.test(navigator.userAgent.toLowerCase());
			base.evt ={x:-1,y:-1};
			base.options.bigImageSrc =base.options.bigImageSrc ==''?base.$el.attr('src'):base.options.bigImageSrc;
			(new Image()).src = base.options.bigImageSrc;
			base.callIndex = $.ImageZoom._calltimes +1;
			base.animateTimer = null;
			$.ImageZoom._calltimes +=1;
			//log('bind:'+'mousemove.imagezoom'+base.callIndex);
			$(document).bind('mousemove.imagezoom'+base.callIndex,function(e){
				if(base.isActive)
				{
					base.moveHandler(e.pageX,e.pageY);
				}
			});
			base.$el.bind('mouseover.imagezoom',function(e){
				base.isActive = true;
				base.showViewer(e);
			});
			
		};
		//Move 
		base.moveHandler = function(x,y){
			
			
			var offset = base.$el.offset(),width=base.$el.outerWidth(false),height=base.$el.outerHeight(false);
			
			if(x>=offset.left && x<=offset.left+width && y>=offset.top && y<=offset.top+height)
			{
				offset.left = offset.left +toNum(base.$el.css('borderLeftWidth'))+toNum(base.$el.css('paddingLeft'));
				offset.top = offset.top + toNum(base.$el.css('borderTopWidth'))+toNum(base.$el.css('paddingTop'));
				width = base.$el.width();
				height = base.$el.height();
				if(x>=offset.left && x<=offset.left+width && y>=offset.top && y<=offset.top+height)
				{
					base.evt = {x:x,y:y};
				if(base.options.type=="follow")
				{
					base.$viewer.css({top:y-base.$viewer.outerHeight(false)/2,left:x-base.$viewer.outerWidth(false)/2});
				}
				if(base.isBigImageReady ==1)
				{
					var bigTop,bigLeft;
					var innerTop = y - offset.top,innerLeft = x-offset.left;
					if(base.options.type=='inner')
					{
						bigTop = -base.$largeImg.height()*innerTop/height + innerTop;
						bigLeft = -base.$largeImg.width()*innerLeft/width + innerLeft;
					}
					else if(base.options.type=="standard")
					{
						var hdLeft=innerLeft-base.$handlerArea.width()/2,hdTop=innerTop - base.$handlerArea.height()/2,
						hdWidth = base.$handlerArea.width(),hdHeight = base.$handlerArea.height();
						if(hdLeft <0)
						{
							hdLeft =0;
						}
						else if(hdLeft>width - hdWidth)
						{
							hdLeft = width - hdWidth;
						}
						if(hdTop<0)
						{
							hdTop =0;
						}
						else if(hdTop > height -hdHeight)
						{
							hdTop = height - hdHeight;
						}
						bigLeft = -hdLeft / base.scale;
						bigTop = -hdTop /base.scale;

						
						if(base.isWebkit)
						{
							base.$handlerArea.css({opacity:.99}); 
							setTimeout(function(){
									base.$handlerArea.css({top:hdTop,left:hdLeft,opacity:1});						   
							},0);
						}
						else
						{
							base.$handlerArea.css({top:hdTop,left:hdLeft});
						}
					}
					else if(base.options.type=="follow")
					{
						
						bigTop = -base.$largeImg.height()/height * innerTop +base.options.zoomSize[1]/2;
						bigLeft = -base.$largeImg.width()/width *  innerLeft +base.options.zoomSize[0]/2;
						
						if(-bigTop > base.$largeImg.height() -base.options.zoomSize[1])
						{
							bigTop = -(base.$largeImg.height()-base.options.zoomSize[1]);
						}
						else if(bigTop>0)
						{
							bigTop =0;
						}
						
						if(-bigLeft >base.$largeImg.width() -base.options.zoomSize[0])
						{
							bigLeft = -(base.$largeImg.width()-base.options.zoomSize[0]);
						}
						else if(bigLeft>0)
						{
							bigLeft =0;
						}
					}
					
					if(base.options.smoothMove)
					{
						window.clearTimeout(base.animateTimer);
						base.smoothMove(bigLeft,bigTop);
					}
					else
					{
						base.$viewer.find('img').css({top:bigTop,left:bigLeft});
					}
				}
				}

			}
			else
			{
				base.isActive = false;
				//hidden the viewer
				base.$viewer.hide();
				base.$handler.hide();
				base.options.onHide(base);
				window.clearTimeout(base.animateTimer);
				base.animateTimer =null;
			}
		};
		//Show the zoom view
		base.showViewer = function(e){
			
			var top = base.$el.offset().top,borderTopWidth = toNum(base.$el.css('borderTopWidth')),paddingTop = toNum(base.$el.css('paddingTop')),left = base.$el.offset().left,borderLeftWidth =toNum(base.$el.css('borderLeftWidth')),paddingLeft = toNum(base.$el.css('paddingLeft'));
			top = top + borderTopWidth+paddingTop;
			left = left +borderLeftWidth+paddingLeft;
			
			var width = base.$el.width();
			var height = base.$el.height();
			if(base.isBigImageReady <1)
			{
				$('div',base.$viewer).remove();
			}
			
			if(base.options.type=='inner')
			{
				base.$viewer.css({top:top,left:left,width:width,height:height}).show();
			}
			else if(base.options.type=='standard')
            {

                var $alignTarget = base.options.alignTo == '' ? base.$el : $('#' + base.options.alignTo);
                var viewLeft, viewTop;

                if (window.innerWidth < 768) {
                    if (base.options.position == 'left') {
                    	viewLeft = left + borderLeftWidth + paddingLeft;
                        viewTop = $alignTarget.offset().top  - ($alignTarget.height()/2 );
                    } else if (base.options.position == 'right') {
                        viewLeft = left + borderLeftWidth + paddingLeft;
                        viewTop = $alignTarget.offset().top  - ($alignTarget.height() );
                    }
 					
                    base.$viewer.css({
                        top: viewTop,
                        left: viewLeft,
                        width: $alignTarget.width(),
                        height: base.options.zoomSize[1] / 2
                    }).show();
                    //zoom handler ajust
                    if (base.$handlerArea) {
                        //been change
                        base.scale = width / base.$largeImg.width();
                        base.$handlerArea.css({
                            width: base.$viewer.width() * base.scale,
                            height: base.$viewer.height() * base.scale
                        });
                    }
                } else {
                    if (base.options.position == 'left') {
                    	var leftSpace = $alignTarget.offset().left;
                    	if((leftSpace) < ($alignTarget.width() / 2)){
                    		viewLeft = left + borderLeftWidth  + $alignTarget.width() + $alignTarget.offset().left;
                        	viewTop = $alignTarget.offset().top + base.options.offset[1];
                    	}else{
						viewLeft = $alignTarget.offset().left - base.options.zoomSize[0] - base.options.offset[0];
                        viewTop = $alignTarget.offset().top + base.options.offset[1];

                    	}

                    } else if (base.options.position == 'right') {
                    	var rightSpace = ( window.innerWidth ) - ($alignTarget.offset().left + $alignTarget.width());

                        if( rightSpace < ($alignTarget.width() / 2)){
                        	viewLeft = $alignTarget.offset().left - base.options.zoomSize[0] - base.options.offset[0];
                    		viewTop = $alignTarget.offset().top + base.options.offset[1];
                        }else{
                        	viewLeft = $alignTarget.offset().left + $alignTarget.width() + base.options.offset[0];
                        	viewTop = $alignTarget.offset().top + base.options.offset[1];
                        }
						  
                    }

                    base.$viewer.css({
                        top: viewTop,
                        left: viewLeft,
                        width: base.options.zoomSize[0],
                        height: base.options.zoomSize[1]
                    }).show();
                    //zoom handler ajust
                    if (base.$handlerArea) {
                        //been change
                        base.scale = width / base.$largeImg.width();
                        base.$handlerArea.css({
                            width: base.$viewer.width() * base.scale,
                            height: base.$viewer.height() * base.scale
                        });
                    }
                }	
				
			}
			else if(base.options.type=="follow")
			{
				base.$viewer.css({width:base.options.zoomSize[0],height:base.options.zoomSize[1],top:e.pageY-(base.options.zoomSize[1]/2),left:e.pageX-(base.options.zoomSize[0]/2)}).show();
			}

			
			base.$handler.css({top:top,left:left,width:width,height:height}).show();
			
			base.options.onShow(base);
			
			if(base.isBigImageReady ==-1)
			{
				base.isBigImageReady =0;
	
				fastImg(base.options.bigImageSrc, function () {

					if($.trim($(this).attr('src')) == $.trim(base.options.bigImageSrc))
					{
						base.$viewer.append('<img src="'+base.$el.attr('src')+'" class="zm-fast" style="position:absolute;width:'+this.width+'px;height:'+this.height+'px"\>');
						base.isBigImageReady = 1;
						base.$largeImg = $('<img src="'+base.options.bigImageSrc+'" style="position:absolute;width:'+this.width+'px;height:'+this.height+'px"\>')
						base.$viewer.append(base.$largeImg);
						if(base.options.type=='standard')
						{
							var scale = width / this.width;
							base.$handlerArea = $('<div class="zm-handlerarea" style="width:'+base.$viewer.width()*scale+'px;height:'+base.$viewer.height()*scale+'px"></div>').appendTo(base.$handler);
base.scale = scale;
					
						}
						//if mouse is in the img before bind mouse move event we can not get x/y from base.evt
						if(base.evt.x ==-1 && base.evt.y ==-1)
						{
							base.moveHandler(e.pageX,e.pageY);
						}
						else
						{
							base.moveHandler(base.evt.x,base.evt.y);
						}
						
						//add description
						if(base.options.showDescription&&base.$el.attr('alt')&&$.trim(base.$el.attr('alt'))!='')
						{
							base.$viewer.append('<div class="'+base.options.descriptionClass+'">'+base.$el.attr('alt')+'</div>');
						}
					}
					else
					{
						//log('change onload');
					}
					
				},function(){
					//log('load complete');
					
				},function(){
					//log('error');
				});
			}
					};
		

		//Change Img
		
		base.changeImage = function(elementImgSrc,bigImgSrc)
		{
			//console.log(this.$el);
			this.$el.attr('src',elementImgSrc);
			this.isBigImageReady=-1;
			this.options.bigImageSrc = typeof bigImgSrc ==='string'?bigImgSrc:elementImgSrc;
			if(base.options.preload) (new Image()).src=this.options.bigImageSrc;
			this.$viewer.hide().empty();
			this.$handler.hide().empty();
			this.$handlerArea =null;
		};
		
		base.changeZoomSize = function(w,h){
			base.options.zoomSize = [w,h];
		};
		
		base.destroy = function(){
			$(document).unbind('mousemove.imagezoom'+base.callIndex);
			this.$el.unbind('.imagezoom');
			this.$viewer.remove();
			this.$handler.remove();
			this.$el.removeData('imagezoom');
		};
		base.smoothMove = function(left,top)
		{
			var times = 10;
			var oldTop = parseInt(base.$largeImg.css('top'));
			oldTop = isNaN(oldTop)? 0:oldTop;
			var oldLeft = parseInt(base.$largeImg.css('left'));
			oldLeft = isNaN(oldLeft)? 0:oldLeft;
			top = parseInt(top),left = parseInt(left);
			
			if(oldTop == top && oldLeft ==left)
			{
				window.clearTimeout(base.animateTimer);
				base.animateTimer = null;
				//console.log('clear timer');
				return;
			}
			else
			{
				var topStep = top-oldTop;
				var leftStep = left -oldLeft;
				
				var newTop = oldTop + topStep/Math.abs(topStep)* Math.ceil(Math.abs(topStep/times));
				var newLeft = oldLeft + leftStep/Math.abs(leftStep) *Math.ceil(Math.abs(leftStep/times));
				
				base.$viewer.find('img').css({top:newTop,left:newLeft});
				
				base.animateTimer = setTimeout(function(){
					base.smoothMove(left,top);
				},10);
			}
		};
		
		//tools
		function toNum(strVal)
		{
			var numVal = parseInt(strVal);
			numVal = isNaN(numVal)? 0:numVal;
			return numVal;
		}
		
		base.init(options);
	};
	//defaults
	$.ImageZoom.defaults = {
		bigImageSrc:'',
		preload:true,
		type:'inner',
		smoothMove: true,
		position:'right',
		offset:[10,0],
		alignTo:'',
		zoomSize:[100,100],
		descriptionClass:'zm-description',
		zoomViewerClass:'',
		zoomHandlerClass:'',
		showDescription:true,
		onShow:function(target){},
		onHide:function(target){}
	};
	
	$.ImageZoom._calltimes = 0;

	//$.fn
	$.fn.ImageZoom = function(options){
		return this.each(function(){
			new $.ImageZoom(this,options);
		});
	};
	
})(jQuery,window);



var fastImg = (function () {
	var list = [], intervalId = null,
	tick = function () {
		var i = 0;
		for (; i < list.length; i++) {
			list[i].end ? list.splice(i--, 1) : list[i]();
		};
		!list.length && stop();
	},
	stop = function () {
		clearInterval(intervalId);
		intervalId = null;
	};

	return function (url, ready, load, error) {
		var onready, width, height, newWidth, newHeight,
			img = new Image();
		img.src = url;
		if (img.complete) {
			ready.call(img);
			load && load.call(img);
			return;
		};
		width = img.width;
		height = img.height;
		img.onerror = function () {
			error && error.call(img);
			onready.end = true;
			img = img.onload = img.onerror = null;
		};
		onready = function () {
			newWidth = img.width;
			newHeight = img.height;
			if (newWidth !== width || newHeight !== height ||newWidth * newHeight > 1024) {
				ready.call(img);
				onready.end = true;
			};
		};
		onready();
		img.onload = function () {
			!onready.end && onready();
			load && load.call(img);
			img = img.onload = img.onerror = null;
		};
		if (!onready.end) {
			list.push(onready);
			if (intervalId === null) intervalId = setInterval(tick, 40);
		};
	};
})();