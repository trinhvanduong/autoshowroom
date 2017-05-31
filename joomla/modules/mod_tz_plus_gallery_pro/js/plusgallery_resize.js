
function TzTemplateResizeImage(obj){
    var widthStage;
    var heightStage ;
    var widthImage;
    var heightImage;
    obj.each(function (i,el){
        heightStage = jQuery(this).height();

        widthStage = jQuery (this).width();


        var theImage = new Image();
        theImage.src = jQuery(this).find('img').attr("src");

        var widthImage = theImage.width;
        var heightImage = theImage.height;

        var tzimg	=	new resizeImage(widthImage, heightImage, widthStage, heightStage);
        jQuery(this).find('img').css ({ top: tzimg.top, left: tzimg.left, width: tzimg.width, height: tzimg.height });
    });

}

