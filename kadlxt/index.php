<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">		
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=0">

	<title>象记</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script> 
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- jsDelivr :: Sortable (http://www.jsdelivr.com/package/npm/sortablejs) -->
	<script src="js/Sortable.min.js"></script>

	<!-- qq分享组件 -->
	<script type="text/javascript" src="https://qzonestyle.gtimg.cn/qzone/qzact/common/share/share.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menustyle.css">
	
</head>
<body>
<script>
	function playadmion(){
		$('#play').show();
		$('#next').fadeIn(300);
		$('#play-1').fadeIn(300);
	}
	function play1(){
		$('#play-1').fadeOut(300);
		$('#play-2').fadeIn(300);
	}
	function play2(){
		$('#play-2').fadeOut(300);
		$('#play-3').fadeIn(300);
	}
	function play3(){
		$('#play-3').fadeOut(300);
		$('#play-4').fadeIn(300);
	}
	function play4(){
		$('#play-4').fadeOut(300);
		$('#play-5').fadeIn(300);
	}
	function play5(){
		$('#play-5').fadeOut(300);
		$('#play-6').fadeIn(300);
	}
	function play6(){
		$('#play-6').fadeOut(300);
		$('#play-7').fadeIn(300);
	}
	function play7(){
		$('#play-7').fadeOut(300);
		$('#play-8').fadeIn(300);
	}
	function play8(){
		$('#next').fadeOut(300);
		$('#play-8').fadeOut(300);
		$('#play').fadeOut(300);
	}
</script>
 <?php 
        $openid = $_GET['openid'];
		
		include('php/conn.php');
		
		//将所有table名放入数组
        function list_tables($database)
		{  
			$rs = $GLOBALS['conn']->query("SHOW TABLES FROM $database");  
			
			$tables = array(); 
			$i=0;
			while ($row =$rs->fetch_assoc()){  
				$tables[$i] = $row['Tables_in_emerynhv_db1'];
				$i++;
			}  
		 
			$rs->free_result();  
			
			return $tables;  
		}

		$tablearr = array();
		$tablearr += list_tables("emerynhv_db1");
		$count = count($tablearr);
		$flag = false;

		//若数据表存在，打印；不存在，以openid为名创建新表
		for($i=0;$i<$count;$i++){
			
			if($openid==$tablearr[$i]){
				$flag = true;
				
				break;
			}
		}

		if($flag){
			//执行打印
			echo "<script> window.onload=function(){ loadDataAll()}; </script>";
		} else {
			
			//创建数据库
			$sbs = 'CREATE TABLE `'.$openid.'` ( `id` INT(9) NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `detail` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , `pretime` date NOT NULL , `preday` INT(5) NOT NULL , `prehour` INT(5) NOT NULL , `importance` INT(1) NOT NULL, `quadrant` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,`idin` INT(5) NOT NULL , PRIMARY KEY (`id`))  ENGINE = MyISAM; ';
			if ($conn->query($sbs) === TRUE) {
				$user = 'insert into userinfo(openid,signafic) values("'.$openid.'","说真的，自律即自由。")';
				$instruction1 = 'insert into `'.$openid.'`(name,detail,pretime,preday,prehour,importance,quadrant,idin) values("欢迎使用象记！","一起享受轻松计划任务的乐趣的乐趣！","2017-12-6",0,0,6,"jinzhong",0)';
				$instruction2 = 'insert into `'.$openid.'`(name,detail,pretime,preday,prehour,importance,quadrant,idin) values("点按左边的白点可以完成事项！","请记住kadlxt.com~！","2017-12-6",0,0,6,"jinzhong",1)';
				$instruction3 = 'insert into `'.$openid.'`(name,detail,pretime,preday,prehour,importance,quadrant,idin) values("点按事项文本可以查看详情！","点击下方分享按钮可以轻松将该事项添加到同校同学事项列表中！（请向同学索取openid，可在对方个人信息页获取）喜欢象记的话还请多多支持！","2017-12-6",0,0,6,"jinzhong",2)';
				if ($conn->query($user) == true){
					// echo "Table MyGuests created successfully";
				} else {
					// echo "用户信息插入错误: " . $conn->error.$flag;
				}
				if ($conn->query($instruction1) == true){
					// echo "Table MyGuests created successfully";
				} else {
					// echo "教程1插入错误: " . $conn->error.$flag;
				}
				if ($conn->query($instruction2) == true){
					// echo "Table MyGuests created successfully";
				} else {
					// echo "教程2插入错误: " . $conn->error.$flag;
				}
				if ($conn->query($instruction3) == true){
					// echo "Table MyGuests created successfully";
				} else {
					// echo "教程3插入错误: " . $conn->error.$flag;
				}
				echo "<script> window.onload=function(){ playadmion(); loadDataAll();}; </script>";
			} else {
			    echo "创建数据表错误: " . $conn->error.$flag;
			}		
		}
		
		$conn->close();


?> 

	<div id="colorbottom"></div>
	<div class="container-main">
		<div class="myrow" id="row1" >
			<div class="col1 col-xs-6" id="important-div">
				<div class="content" id="important">
					    				
				</div>
				<!-- <a class="btn btn-primary" id="plus"  ></a> -->

					<nav class="cd-stretchy-nav">
						<a class="cd-nav-trigger" href="#0">
							<span aria-hidden="true"></span>
						</a>

						<ul id="menuul">
							<li >
								<a onclick="restoreContent()">
									<span class="glyphicon glyphicon-repeat" style="color:rgb(255, 255, 255);top: 15px;right: 8px;"></span>
								</a>
							</li>
							<li  id="plus">
								<a>
									<span class="glyphicon glyphicon-plus" style="color:rgb(255, 255, 255);top: 15px;right: 8px;"></span>	
								</a>
							</li>
							<li>
								<a href="userInfo.php?openid=<?php echo $openid; ?>">
									<span class="glyphicon glyphicon-user" style="color:rgb(255, 255, 255);top: 15px;right: 8px;"></span>
								</a>
							</li>
							<li>
								<a onclick="playadmion()">
									<span class="glyphicon glyphicon-info-sign" style="color:rgb(255, 255, 255);top: 15px;right: 8px;"></span>
								</a>
							</li>
							<!-- <li><a href="#0"><span>Store</span></a></li>
							<li><a href="#0"><span>Contact</span></a></li> -->
						</ul>

						<span aria-hidden="true" class="stretchy-nav-bg"></span>
					</nav>

			</div>
			<div class="col2 col-xs-6" id="jinzhong-div">
				<div class="content" id="jinzhong">
					<!-- <div class="list" id="list2">
						<input type="checkbox" value="guangpan" name="choose" id="guangpan">
  						<label for="guangpan">Inmportant and Emergent1</label>
						<span class="glyphicon glyphicon-option-vertical"></span>
						<p>Inmportant and Emergent1</p>
								
					</div>
					<div class="list" id="list2">
						<span class="glyphicon glyphicon-option-vertical"></span>
						<p>Inmportant and Emergent2</p>
								
					</div> -->
				</div>
			</div>
		</div>        	
		<div class="myrow" id="row2">
			<div class="col1 col-xs-6" id="inconsequential-div">
				<div class="content" id="inconsequential">
					<!-- <div class="list" id="list3">
						<span class="glyphicon glyphicon-option-vertical"></span>
						<p>Inconsequential1</p>
						
					</div> -->
				</div>
			</div>
			<div class="col2 col-xs-6" id="jinji-div">
				<div class="content" id="jinji">
					<!-- <div class="list" id="list1">
						<span class="glyphicon glyphicon-option-vertical"></span>
						<p>Emergenct1</p>
							
					</div> -->
				</div>
			</div>
		</div>
	</div>
		
	<!-- container2 -->
    <div class="container" id="new">

		<!-- 关闭按钮 -->
		<button type="button" id="gback"><span class="glyphicon glyphicon-remove" style="color: rgb(255, 255, 255); font-size:20px;color:cornsilk;z-index:1"></span></button>
		<div id="new-header">
			<p>添加新项</p>
		</div>
		<!-- 表单 -->
		<form class="form-horizontal" id="myForm" role="form" style="margin:6% 5% 5% 5%" autocomplete="off"> 
			<div class="formgroup" >
				<label class="col-xs-3" for="name">事项名称</label>
				<div class="col-xs-9">
    				<input type="text"  name="name" id="name" placeholder="请输入名称">
				</div>
			</div>
		
			<div class="formgroup textarea" >
   			    <label class="col-xs-3" for="detail"><br>事项详情</label>
   			    <div class="col-xs-9">
    				<textarea  rows="3" name="detail" placeholder="请输入详情"></textarea>
  				</div>
			</div>
			
  			<div class="formgroup">
  				<label class="col-xs-3" for="pretime">截止日期</label>
  				<div class="col-xs-9">
  					<input type="date" name="pretime" id="pretime" style="text-align:center">
  				</div>
			</div>
			<br>
  			<div class="formgroup">
  				<label class="col-xs-3" for="preday">预留日期</label>
				<div class="col-xs-3 ">
					<select name="preday" >
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="35">35</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
					</select>
				</div>
				<span  class="col-xs-1">天</span>
				<div class="col-xs-3 ">
						<select name="prehour" >
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
						</select>
				</div>
				<span  class="col-xs-2">时</span>
  			</div>

			
            <div class="formgroup">
				<label class="col-xs-3" for="importance">重要程度</label> 
				<div class="col-xs-3 ">
						<select name="importance" >
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
						</select>
					</div>
					<span  class="col-xs-1">级</span>
			</div><br>
			<button type="button" id="buttonSubmit"><img src="./img/2.png" style="height:40px;width:24px;position: relative;left: -1px;" ></button>
        </form>
       
		
	</div>
	<div id="play" style="height: 100%;width: 100%;position: absolute;top: 0;left: 0;z-index: 9;display: none;background: #eeeeee">
		<div id="play-1" style="display: none;height: 100%;width: 100%;position: absolute;top: 10%;">
			<img src="./img/start1.png" onclick="play1()" style="height: auto;width: 100%" />
		</div>
		<div id="play-2" style="display: none;height: 100%;width: 100%">
			<img src="./img/start0.png" onclick="play2()" style="height: 100%;width: 100%" />
		</div>
		<div id="play-3" style="display: none;height: 100%;width: 100%">
			<img src="./img/start2.png" onclick="play3()" style="height: 100%;width: 100%" />
		</div>
		<div id="play-4" style="display: none;height: 100%;width: 100%">
			<img src="./img/start3.png" onclick="play4()" style="height: 100%;width: 100%" />
		</div>
		<div id="play-5" style="display: none;height: 100%;width: 100%">
			<img src="./img/start4.png" onclick="play5()" style="height: 100%;width: 100%" />
		</div>
		<div id="play-6" style="display: none;height: 100%;width: 100%">
			<img src="./img/start5.png" onclick="play6()" style="height: 100%;width: 100%" />
		</div>
		<div id="play-7" style="display: none;height: 100%;width: 100%">
			<img src="./img/start6.png" onclick="play7()" style="height: 100%;width: 100%" />
		</div>
		<div id="play-8" style="display: none;height: 100%;width: 100%">
			<img src="./img/logo2.png" onclick="play8()" style="height: auto;width: 100%" />
		</div>
		<div id="next" style="display: none;position: absolute;bottom: 3%;right:0">
			<p style="color:rgba(142, 187, 183, 0.84);font-weight:700" >点击图片进入下一页→</p>
		</div>
	</div>

	<script>

		setShareInfo({
			title:   '象记',
			summary: '——最好用的象限管理法',
			pic:     'https://www.kadlxt.com/kadlxt/img/logo.jpg',
			url:     "https://www.kadlxt.com/kadlxt/loginByShare.html"
		});

		document.querySelector('body').addEventListener('touchmove', function(e) {
			if (!document.querySelector('.list').contains(e.target)) {
				e.preventDefault();
			}
		});

		function loadData(quadrant)
		{
			$.ajax({  
				type: "GET",  
				url:"php/loadData.php?quadrant="+quadrant+"&openid=<?php echo $openid; ?>",   
				async: true,  
				error: function(XMLHttpRequest, textStatus, errorThrown) {  
					// alert("Connection error");
					console.log(XMLHttpRequest.status);
					console.log(XMLHttpRequest.readyState);
					console.log(textStatus);
					console.log(errorThrown);
				},  
				success: function(data) {  					
					// alert(data);
					document.getElementById(quadrant).innerHTML=data;

					var lists = $("#"+quadrant+ " .list span");
					// alert("ok");
					//添加拖动监听
					if(lists.length > 0) {
						lists.each(function(){
							var list = $(this).get(0);
							list.addEventListener('touchmove', onTouchMove);
						});
					}
				}  
			});	
		}

		function loadDataAll(){
			loadData("inconsequential");
			loadData("jinji");
			loadData("jinzhong");
			loadData("important");
		}
		
		function updateIdin(){
			var lists = $(".list");

			lists.each(function(){
				var idin = $(this).attr("data-idin");
				var id = $(this).attr("id");
				var quadrant = $(this).parent().attr("id");
				// alert(id+idin);
				$.ajax({  
					type: "POST",  
					url:"php/updateId.php?openid=<?php echo $openid; ?>",  
					data:{"id":id,"idin": idin,"quadrant":quadrant},  
					async: true,  
					error: function(request) {  
						alert("Connection error");  
					},  
					success: function(data) {  
						// alert(data);
					}  
				});
			});
		}

		$("#buttonSubmit").click(function(){
			$.ajax({  
				type: "POST",  
				url:"php/action.php?openid=<?php echo $openid; ?>",  
				data:$('#myForm').serialize(),  
				async: false,  
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest.status);
					alert(XMLHttpRequest.readyState);
					alert(textStatus);
				},  
				success: function(data) {  
					// 接收后台返回的结果 
					// alert(data);
				}  
			});		
			// location.reload();	
			loadDataAll();
			restoreContent();
			$('#new').hide(500);
        	$('#colorbottom').hide(500);
		});
		
	</script>
			
	<script src="js/sortableThings.js"></script>
	<script src="js/app.js"></script>
		
</body>
</html>

<script type="text/javascript">
    // function checkOrKnock(el){
		
	// 	if (el.tagName == "LABEL" || el.tagName == "INPUT"){
	// 		// if ($(".content-active").length != 0){
	// 			$(el).parent().children("label::before").css("background","steelblue");
	// 			$(el).parent().delay(1000);
	// 			$(el).parent().hide(200);
	// 			setTimeout(function() {
	// 				$(el).parent().remove();
	// 			}, 1200);
	// 		// }
	// 	} else {
	// 		var id=el.id?el.id:el.parentNode.id;
	// 		var pshowid = 'listDetails.php?id='+id+"&openid=<?php echo $openid; ?>";
	// 		window.location.href=pshowid;
	// 	}
	// }
	function checkOrKnock(){
		console.log(event.target.tagName+$(".content-active").length);
		str = event.target.tagName+$(".content-active").length;
		var el=event.target;

		if ($(".content-active").length != 0) {
			if (el.tagName == "LABEL" || el.tagName == "INPUT"){
				$(el).parent().delay(400);
				$(el).parent().hide(200);
				setTimeout(function() {
					$(el).parent().remove();
				}, 1000);
				$.ajax({
					type: "GET", 
					url:"php/deleteList.php?id="+el.parentNode.id+"&openid=<?php echo $openid; ?>",    
					async: true,  
					error: function(request) {  
						alert("Connection error");  
					},  
					success: function(data) {  
						//接收后台返回的结果 
						// alert(data);
					} 
				});
			}
			else {
				var id=el.id?el.id:el.parentNode.id;
			var pshowid = 'listDetails.php?id='+id+"&openid=<?php echo $openid; ?>";
			window.location.href=pshowid;
			}
		}
	}
	
</script>
