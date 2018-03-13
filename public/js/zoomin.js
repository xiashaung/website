/**
 * Created by 123 on 2017/12/4.
 */
function zoomInfa(_th){
//        // 获取窗口宽度
//        if (window.innerWidth)
//            winWidth = window.innerWidth;
//        else if ((document.body) && (document.body.clientWidth))
//            winWidth = document.body.clientWidth;
// 获取窗口高度
    var winHeight;
    if (window.innerHeight)
        winHeight = window.innerHeight;
    else if ((document.body) && (document.body.clientHeight))
        winHeight = document.body.clientHeight;
// 通过深入 Document 内部对 body 进行检测，获取窗口大小
    if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth)
    {
        winHeight = document.documentElement.clientHeight;
//            winWidth = document.documentElement.clientWidth;
    }
    var zoomin= $('.zoomIn');
    zoomin.css({'height':winHeight+"px",'line-height':winHeight+"px"});
    var thisurl=_th.attr('src');
    var zoomimg=$(".zoomIn img");
    zoomimg.attr('src',thisurl);
    zoomin.slideDown("fast");
}
$('.zoominimg img').bind('click',function(){
    zoomInfa($(this));
});
$(".zoomIn").bind('click',function(e){
    var classname=e.target.className;
    console.log(classname);
    if(classname=="zoomIn"){
        $(this).slideUp("fast");
    }
})