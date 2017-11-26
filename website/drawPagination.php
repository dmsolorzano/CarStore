<?php 

	$currentPage = $_GET['currentPage'];
	$totalPages = $_GET['totalPages'];
	$maxItemsPerPage = $_GET['maxItemsPerPage'];


echo "
<div class=\"pagination\">
  <a href=\"#\"  onclick=\"getPage($currentPage - 1, $totalPages, $maxItemsPerPage);\">&laquo;</a>
";

	
	//special boundary cases
	if(($currentPage < 7) || (($currentPage + 7) > $totalPages)){

		if($currentPage < 7){
			for($j = 1; $j <= 7; $j++){
				if($j == $currentPage){
					echo "<a href=\"#\" class=\"active\" onclick=\"getPage($j, $totalPages, $maxItemsPerPage);\">" . $j . "</a>";
				}else{
					echo "<a href=\"#\" onclick=\"getPage($j, $totalPages, $maxItemsPerPage);\">" . $j . "</a>";
				}

			}
		}
		
	}else{//current page should always be centered in the pagination tab.
		for($i = ($currentPage - 3); $i<=($currentPage + 3); $i++){
			if($i == $currentPage){
				echo "<a href=\"#\" class=\"active\" onclick=\"getPage($i, $totalPages, $maxItemsPerPage);\">" . $i . "</a>";
			}else{
				echo "<a href=\"#\" onclick=\"getPage($i, $totalPages, $maxItemsPerPage);\">" . $i . "</a>";
			}
		}
	}



echo "<a href=\"#\"  onclick=\"getPage($currentPage + 1, $totalPages, $maxItemsPerPage);\">&raquo;</a>
</div>
";


?>