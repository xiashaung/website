
var treeli=$('.tree li');
function opentree(a){
    a.siblings('ul').slideToggle("fast");
    a.toggleClass('fa-minus-square-o');
    a.toggleClass('fa-plus-square-o');
}
function i(){
    if(treeli.find('.all')){
        $('.all').parents("li").prepend('<i class="fa fa-plus-square-o" onclick="opentree($(this))"></i>')
    }
}
function checkedall(a){
    var check=  a.siblings('ul').find('input');
    if(a.find('input').get(0).checked){
        check.each(function () {
            this.checked="checked"
        })
    }else{
        check.each(function () {
            $(this).removeAttr("checked");
        })
    }
}
function reall(a){
    if(!a.get(0).checked){
        a.parents('li').find(".all").find('input').removeAttr("checked")
    }
}
$(".checkbox-inline input").bind('click', function () {
    reall($(this))
});
$(".all").bind('click', function (){
    checkedall($(this));
});
i();
