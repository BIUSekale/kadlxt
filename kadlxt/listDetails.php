<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=0">

	<title>详情</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	
	 
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>	 
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!-- qq分享组件 -->
	<script type="text/javascript" src="https://qzonestyle.gtimg.cn/qzone/qzact/common/share/share.js"></script>

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style="background:rgba(182, 205, 203, 0.7)">

<?php
    include("php/conn.php");

	$id = $_GET["id"];
	$openid = $_GET['openid'];
	$sql = 'SELECT * FROM '.$openid.' WHERE id="'.$id.'"';

	$result = $conn->query($sql);
    if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$name = $row["name"];
		$detail = $row["detail"];
		$pretime = $row["pretime"];
		$preday = $row["preday"];
		$prehour = $row["prehour"];
		$importance = $row["importance"];

		$y = date("Y",strtotime($pretime));
		$m = date("m",strtotime($pretime));
		$d = date("d",strtotime($pretime));
	}

	$conn->close();
?>

	<div class="container-main scroll" style="text-align:center;">

	<form id="listForm">
		<header id="list-head">
			<button id="btn-b" type="button"><span class="glyphicon glyphicon-chevron-left"></span></button>
			<input id="list-title" name="name" maxlength="10" value="<?php echo $name; ?>" readonly>
			<button id="btn-modify" type="button"><span class="glyphicon glyphicon-pencil"></span></button>
			<button id="btn-delete" onclick="onClickDel()" type="button"><span class="glyphicon glyphicon-trash"></span></button>
		</header>
		<section id="list-body">
			<span class="col-xs-3">截止时间</span>
			<p class="col-xs-9 static" style="color:#4a686b"><?php echo $y; ?>&nbsp;年&emsp;<?php echo $m; ?>&nbsp;月&emsp;<?php echo $d; ?>&nbsp;日</p>
			<input class="col-xs-9 editable" type="date" name="pretime" id="pretime" value="<?php echo $pretime; ?>" style="text-align:center;color:#4a686b;border:0;background:rgba(254, 170, 157, 0.1)">
			<br><hr style="margin-left:27%">


			<span class="col-xs-3">重要程度</span>
			<p class="col-xs-9 static" style="color:#4a686b"><?php echo $importance; ?>&nbsp;级</p>
			<select class="col-xs-9 editable" name="importance" style="text-align:center;color:#4a686b;border:0;background:rgba(254, 170, 157, 0.1)">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
			</select>
			<br><hr style="margin-left:27%">

			<span class="col-xs-3">预估耗时</span>
			<p class="col-xs-9" style="color:#4a686b">
				<input class="text-in-body" type="number" name="preday" min="0" value="<?php echo $preday; ?>" style="width:20%;border:0;text-align:center" readonly="readonly" >
				&nbsp;天&emsp;
				<input class="text-in-body" type="number" name="prehour" min="0" value="<?php echo $prehour; ?>" style="width:20%;border:0;text-align:center" readonly="readonly" >
				&nbsp;小时</p>
			<br><hr style="margin-left:27%">

			<span class="col-xs-3">事项备注</span>
			<!-- <p class="col-xs-9" style="color:#4a686b">找我可爱的宝贝吃饭饭。</p> -->
			<textarea class="col-xs-9 text-in-body" id="usersignature" name="detail" style="font-size:15px;border:0;resize:none;color:#4a686b;border-bottom: 1px solid #eee;" rows="7" cols="25" maxlength="70" readonly="readonly"><?php echo $detail; ?></textarea>
			<br>


		</section>	
	</form>
	<div id="btn-share-div" >
		<button id="btn-share">
			<span class="glyphicon glyphicon-share" style="color: #eee">邀请同校好友一起完成</span>
		</button>
		<br><br><br><br>
	</div>
	
	</div>
	<script>
		setShareInfo({
			title:   '象记',
			summary: '——最好用的象限管理法',
			pic:     'https://www.kadlxt.com/kadlxt/img/logo.jpg',
			url:     "https://www.kadlxt.com/kadlxt/loginByShare.html"
		});

		function overscroll(el) {
            el.addEventListener('touchstart', function() {
                var top = el.scrollTop;
                var totalScroll = el.scrollHeight;
                var currentScroll = top + el.offsetHeight;
                //If we're at the top or the bottom of the containers
                //scroll, push up or down one pixel.
                //
                //this prevents the scroll from "passing through" to
                //the body.
                if(top === 0) {
                    el.scrollTop = 1;
                } else if(currentScroll === totalScroll) {
                    el.scrollTop = top - 1;
                }
            });
            el.addEventListener('touchmove', function(evt) {
                //if the content is actually scrollable, i.e. the content is long enough
                //that scrolling can occur
                if(el.offsetHeight < el.scrollHeight)
                    evt._isScroller = true;
            });
        }
        overscroll(document.querySelector('.scroll'));

        document.body.addEventListener('touchmove', function(evt) {
            //In this case, the default behavior is scrolling the body, which
            //would result in an overflow.  Since we don't want that, we preventDefault.
            if(!evt._isScroller) {
                evt.preventDefault();
            }
        });

		$('#btn-share').click(function(){
			var openid=prompt("请输入要分享好友的身份标识码 (好友还没加入象记？点击右上角分享↗)","");
			if(openid.length < 32||openid.length>32){
				alert("这不是一个有效的身份标识");
			}
			else
			{			
				var date  = "<?php echo $pretime; ?>";
				var day = <?php echo $preday; ?>;
				var hour = <?php echo $prehour; ?>;
				var impor = <?php echo $importance; ?>;
				var surl="php/share.php?name="+"<?php echo $name; ?>"+"&pretime="+date+"&preday="+day+"&prehour="+hour+"&importance="+impor+"&openid="+openid;
				$.ajax({  
					type: "POST",  
					url:surl,    
					async: true,  
					error: function(request) {  
						alert("Connection error");  
					},  
					success: function(data) {  
						//接收后台返回的结果 
						alert('任务分享成功');
						// alert(data);
					}  
				});
			}
		})
	
		var editing = false;
		console.log(editing);
		$("#btn-modify").click(function(){
			if(!editing){
				editing = true;
				$("input").removeAttr("readonly");
				$("textarea").removeAttr("readonly");
				$("header input").focus();
				$("#btn-modify span").attr("class","glyphicon glyphicon-ok");
				$(".editable").css("display","block");
				$(".static").css("display","none");
				console.log(editing);
			}
			else {
				editing = false;
				$("input").attr("readonly","readonly");
				$("textarea").attr("readonly","readonly");
				$("#btn-modify span").attr("class","glyphicon glyphicon-pencil");
				$(".editable").css("display","none");
				$(".static").css("display","block");
				console.log(editing);
				upload();
				location.reload();
			}
		});

	var today = new Date();
    var day = ("0" + today.getDate()).slice(-2);
    var month = ("0" + (today.getMonth() + 1)).slice(-2);
    var now = today.getFullYear()+"-"+month+"-"+day;
    document.getElementById("pretime").value = now;
    
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
	})
	
	$("#btn-b").click(function(){
		window.location.href="index.php?openid=<?php echo $openid; ?>";
	});

	function upload (){
		//先删除
		del();

		//在创建一个新的
		$.ajax({
			type: "POST", 
			url:"php/action.php?id=<?php echo $id; ?>"+"&openid=<?php echo $openid; ?>",  
			data:$('#listForm').serialize(),  
			async: false,  
			error: function(request) {  
				alert("Connection error");  
			},  
			success: function(data) {  
				//接收后台返回的结果 
				// alert(data);
			} 
		});
	}

	function del() {
		$.ajax({
			type: "GET", 
			url:"php/deleteList.php?id=<?php echo $id; ?>&openid=<?php echo $openid; ?>",    
			async: false,  
			error: function(request) {  
				alert("Connection error");  
			},  
			success: function(data) {  
				//接收后台返回的结果 
				// alert(data);
			} 
		});
	}

	function onClickDel(){
		var r=confirm("删除后无法找回，确认删除？");
		if(r == true){
			del();
			window.location.href="index.php";
		}
	}
	</script>

</body>
</html>