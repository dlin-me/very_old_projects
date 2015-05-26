<?php include TPL_ROOT."/page_header.php";?>

	<!-- Start of Content  -->
 <div id="Content">
 		 
		<!-- Start of Left Content  -->

		<div id="Left">
		  <?php
		  	if(isset(Page::$data['COL_LEFT'])){
		   		foreach (Page::$data['COL_LEFT'] as $file){
		  			include TPL_ROOT.'/'.$file.'.php';
		   		}
		  	}
		  ?>
		</div>

		<!-- Start Of Middle -->
		<div id="Middle"  >
		<?php
		  	if(isset(Page::$data['COL_MID'])){
		   		foreach (Page::$data['COL_MID'] as $file){
		  			include TPL_ROOT.'/'.$file.'.php';
		   		}
		  	}
		 ?>
		</div>

		<!-- Start Of Right -->
		<div id="Right" >
		<?php
		  	if(isset(Page::$data['COL_RIGHT'])){
		   		foreach (Page::$data['COL_RIGHT'] as $file){
		  			include TPL_ROOT.'/'.$file.'.php';
		   		}
		  	}
		 ?>
		</div>

		<div style="float:none; clear:both "></div>
 </div>

<?php include TPL_ROOT."/page_footer.php";?>