/**
 * Created by 123 on 2017/11/28.
 */
detal();
function detal(){
    var a=window.location.href;
    var item2=$(".nav-link");
    item2.each(function(){
        var _url=$(this).attr('href');
        if(a.indexOf(_url)!=-1){
            $(this).addClass('start active open');
            $(this).siblings().removeClass('start active open');
            $(this).parents('.nav-item').addClass('start active open');
            $(this).parents('.nav-item').siblings().removeClass('start active open');
            $(this).parent().parent().show();  
        }
    });
}