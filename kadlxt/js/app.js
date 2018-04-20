
//伸缩导航栏以及触发按钮
var stretchyNav = $('.cd-stretchy-nav');
stretchyNavTrigger = stretchyNav.find('.cd-nav-trigger');


/**
 * 事件绑定
 */
function bindEvent (){

    //四个象限的点击事件
    $("#important").click(switchContent);
    $("#jinzhong").click(switchContent);
    $("#inconsequential").click(switchContent);
    $("#jinji").click(switchContent);

    //有关新建部分的按钮
    $('#plus').click(function(){
        $('#new').show(500);
        $('#colorbottom').show(500);
        
    })
    $('#gback').click(function(){
        $('#new').hide(500);
        $('#colorbottom').hide(500);
    })

    //时间验证，不能在今天之前
    $('#pretime').change(function(){
        var changed = document.getElementById('pretime').value;
        var today = new Date();
        var day = ("0" + today.getDate()).slice(-2);
        var month = ("0" + (today.getMonth() + 1)).slice(-2);
        var now = today.getFullYear()+"-"+month+"-"+day;

        if(changed < now){
            alert('截止日期不能在今天之前哦。');
            document.getElementById("pretime").value = now;
        }
    });

    //判断菜单打开方向
    stretchyNavTrigger.on('click', function(event){
        var contentActive = $(".content-active").attr("id");
        //判断当前活跃象限，若菜单位置在上方则向下打开，在下方则向上
        if (contentActive == "jinji" || contentActive == "inconsequential") {
            
            $(".cd-stretchy-nav").css("bottom","-240px");
            $(".stretchy-nav-bg").css("bottom","");
            $(".cd-nav-trigger").css("top","0");
            $(".cd-nav-trigger").css("bottom","");
            $(".stretchy-nav-bg").css("top","0");
            $("#menuul").css("bottom","0");
        } else {
            $(".cd-stretchy-nav").css("bottom","-30px");
            $(".stretchy-nav-bg").css("bottom","0");
            $(".stretchy-nav-bg").css("top","");
            $(".cd-nav-trigger").css("bottom","0");
            $(".cd-nav-trigger").css("top","");
            $("#menuul").css("bottom","50px");
        }

        event.preventDefault();
        stretchyNav.toggleClass('nav-is-visible');

    });

    //再次点击任意一处缩回导航
    $(document).on('click', function(event){
        ( !$(event.target).is('.cd-nav-trigger') && !$(event.target).is('.cd-nav-trigger span') ) && stretchyNav.removeClass('nav-is-visible');
    });
}


/**
 * 拖动修改象限
 * 
 * @param e：拖动事件 
 */
function onTouchMove(e){

    e.preventDefault();
    var $lastQuadrant = $('#jinji-div');
    var x = e.touches[0].clientX;
    var y = e.touches[0].clientY;
    var centerX = $lastQuadrant.offset().left;
    var centerY = $lastQuadrant.offset().top;
    var oldQuadrant;
    var newQuadrant;

    if (document.getElementsByClassName('content-active').length == 0)
        oldQuadrant = null;
    else
        oldQuadrant = document.getElementsByClassName('content-active')[0].id;

    //判断鼠标在第几象限
    if (x <= centerX && y <= centerY){
        newQuadrant = 'important';          
    }
    if (x >= centerX && y <= centerY){
        newQuadrant = 'jinzhong';   
    }
    if (x >= centerX && y >= centerY){
        newQuadrant = 'jinji';
    }
    if (x <= centerX && y >= centerY){
        newQuadrant = 'inconsequential';
    }

    //若拖动到别的象限，则更改当前象限
    if(oldQuadrant != newQuadrant){
        $el = $('#'+newQuadrant);
        switchContentWithArg($el);
    }
}


/**
 * 鼠标点击时切换象限
 */
function switchContent (){
    $el = $(this); 
    switchContentWithArg($el);
}

/**
 * 含参数的象限切换
 * @param $el: 当前象限参数
 */
function switchContentWithArg ($el){
    
    //获取本行id，并设置高度
    row1 = "#" + $el.parent().parent().attr("id");
    $(row1).css("height","90%");
    $(row1).siblings().css("height","10%");

    //确定本列
    var col1,col2;
    if ($el.parent().hasClass("col1")) {
        col1="col1";
        col2="col2";
    }
    else {
        col1="col2";
        col2="col1";
    }

    //修改列的宽度
    $("."+col1).attr("class", col1 + " col-xs-10");
    $("."+col2).attr("class", col2 + " col-xs-2");

    // content渐入渐出
    //将所有content-active类改回普通类，以防冲突，并排除plus按钮
    $('.content-active').attr("class","content");

    // 将当前点击的元素设为content-active类
    $el.attr("class","content-active");

    $(".content").children().each(function() {
        $(this).fadeOut();
    }, this);
    
    
    $(".content-active").children().each(function() {
        $(this).delay(500);
        $(this).fadeIn();
    }, this);
}

/**
 * 回到均分四宫格状态
 */
function restoreContent (){
    
    $(".myrow").css("height","50%");

    //修改列的宽度
    $(".col1").attr("class", "col1 col-xs-6");
    $(".col2").attr("class", "col2 col-xs-6");
    
    //将content-active类改回普通类
    $('.content-active').attr("class","content");


    $(".content").children().each(function() {
        $(this).delay(500);
        $(this).fadeIn();
    }, this);
}

/**
 * 获取当天时间
 */
function getDateDow() {
    var today = new Date();
    var day = ("0" + today.getDate()).slice(-2);
    var month = ("0" + (today.getMonth() + 1)).slice(-2);
    var now = today.getFullYear()+"-"+month+"-"+day;
    document.getElementById("pretime").value = now;
}

/**
 * 初始化
 */
function init(){
    bindEvent();
    getDateDow();
}

init();