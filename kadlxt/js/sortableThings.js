important = $('#important').get(0);
jinzhong = $('#jinzhong').get(0);
jinji = $('#jinji').get(0);
inconsequential = $('#inconsequential').get(0);

Sortable.create(important,{
    group:'quadrant',
    handle: ".glyphicon",
    animation:100,

    onEnd: function(evt){
        changeIdin(evt);
    }
});
Sortable.create(jinzhong,{
    group:'quadrant',
    handle: ".glyphicon",
    animation:100,

    onEnd: function(evt){
        changeIdin(evt);
    }
});
Sortable.create(jinji,{
    group:'quadrant',
    handle: ".glyphicon",
    animation:100,

    onEnd: function(evt){
        changeIdin(evt);
    }
});
Sortable.create(inconsequential,{
    group:'quadrant',
    handle: ".glyphicon",
    animation:100,

    onEnd: function(evt){
        changeIdin(evt);
    }
});


/**
 * 
 * @param  evt:拖动事件
 */
function changeIdin (evt) {
    
    var itemEl = evt.item;  // 被拖动的HTMLElement元素
    var pre = evt.from.children;
    var aft = evt.to.children;
    var old = evt.oldIndex;
    var now = evt.newIndex;
    if (evt.from == evt.to){
        if(old < now) {
            for (var i = old; i < now; i++) {
                var element = pre[i];
                var idin = $(element).attr("data-idin");
                idin--;
                $(element).attr("data-idin",idin);
            }
        } else if(old > now) {
            for (var i = now + 1; i < old + 1; i++) {
                var element = pre[i];
                var idin = $(element).attr("data-idin");
                idin++;
                $(element).attr("data-idin",idin);
            }
        }
    } else {
        for (var i = old; i < pre.length; i++) {
            var element = pre[i];
            var idin = $(element).attr("data-idin");
            idin--;
            $(element).attr("data-idin",idin);
        }
        for (var i = now + 1; i < aft.length; i++) {
            var element = aft[i];
            var idin = $(element).attr("data-idin");
            idin++;
            $(element).attr("data-idin",idin);
        }
    }      
    
    $(itemEl).fadeIn();
    $(itemEl).attr("data-idin",now);
    updateIdin();
}