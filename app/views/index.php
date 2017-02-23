<script src="/public/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<?php
echo "qqq";
echo "<br/>";

echo "aaaaa";
echo "<br/>";
?>
<?php foreach($aaa as $a):?>
<h1><?php echo $a?></h1>
<?php endforeach;?>
<script>
 var app_id = 111;
 $.ajax({
	url:"/index/home",
	type:"post",
	dataType:"json",
	data:{
		app_id:app_id
	},
	success:function(data){
		if(data.error==0){
			alert(data.errmsg);
			//history.go(0);
		}else{
			alert(data.errmsg);
			return false;
		}
	}
})
</script>