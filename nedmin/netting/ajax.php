<?php
 
	$db = new PDO("mysql:host=localhost;dbname=c2c;charset=utf8", "root", "");
	$il_id=$_POST["il_id"];
	
	$ilcelist= $db->query("select* from ilce where il_id='" .$il_id."'")->fetchAll(PDO::FETCH_ASSOC);
	
	
		
	
			foreach($ilcelist as $key=>$value){
			echo	'<option value="'.$value['ilce_id'].'">'.$value['ilce_ad'].'</option>';
			}
		
	
	
?>
<script type="text/javascript">
$(document).ready(function(){
	
	$("#ilce_id").change(function(){
		//alert("değişti");
		var ilce_id=$(this).val();
		alert(ilce_id);
		
});

		
	})
	
});

</script>