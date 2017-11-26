<?php 
	
	session_start();
	//session_unset('currentPage');
	/*$_SESSION['currentPage'] =*/ $currentPage = $_GET['currentPage'];
	$totalPages = $_GET['totalPages'];
	$maxItemsPerPage = $_GET['maxItemsPerPage'];

echo "
<div class=\"pagination\">
  <a href=\"#\"  onclick=\"drawPagination($currentPage - 1, $totalPages, $maxItemsPerPage);\">&laquo;</a>
";

	
	//special boundary cases
	if(($currentPage < 7) || (($currentPage + 3) > $totalPages)){

		if($currentPage < 7){
			for($j = 1; ($j <= 7)&&(!($j > $totalPages)); $j++){
				if($j == $currentPage){
					echo "<a href=\"#\" class=\"active\" onclick=\"drawPagination($j, $totalPages, $maxItemsPerPage);\">" . $j . "</a>";
				}else{
					echo "<a href=\"#\" onclick=\"drawPagination($j, $totalPages, $maxItemsPerPage);\">" . $j . "</a>";
				}

			}
		}else{
		if(($currentPage + 3) > $totalPages){
			for($j = ($totalPages - 6); ($j <= $totalPages); $j++){
				if($j == $currentPage){
					echo "<a href=\"#\" class=\"active\" onclick=\"drawPagination($j, $totalPages, $maxItemsPerPage);\">" . $j . "</a>";
				}else{
					echo "<a href=\"#\" onclick=\"drawPagination($j, $totalPages, $maxItemsPerPage);\">" . $j . "</a>";
				}

			}

		}
		}
		
	}else{//current page should always be centered in the pagination tab.
		for($i = ($currentPage - 3); ($i<=($currentPage + 3))&&($i<=$totalPages); $i++){
			if($i == $currentPage){
				echo "<a href=\"#\" class=\"active\" onclick=\"drawPagination($i, $totalPages, $maxItemsPerPage);\">" . $i . "</a>";
			}else{
				echo "<a href=\"#\" onclick=\"drawPagination($i, $totalPages, $maxItemsPerPage);\">" . $i . "</a>";
			}
		}
	}



echo "<a href=\"#\"  onclick=\"drawPagination($currentPage + 1, $totalPages, $maxItemsPerPage);\">&raquo;</a>
</div>
";


?>