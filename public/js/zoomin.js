/**
 * Created by 123 on 2017/12/4.
 */
function zoomInfa(_th){
//        // ��ȡ���ڿ��
//        if (window.innerWidth)
//            winWidth = window.innerWidth;
//        else if ((document.body) && (document.body.clientWidth))
//            winWidth = document.body.clientWidth;
// ��ȡ���ڸ߶�
    var winHeight;
    if (window.innerHeight)
        winHeight = window.innerHeight;
    else if ((document.body) && (document.body.clientHeight))
        winHeight = document.body.clientHeight;
// ͨ������ Document �ڲ��� body ���м�⣬��ȡ���ڴ�С
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