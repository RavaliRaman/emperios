<style type="text/css">
div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 1px;
	border: 1px solid #AAAADD;
	background:#EEE;
	
	text-decoration: none; /* no underline */
	color: #FF9933;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;

	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
		border: 1px solid #000099;
		
		font-weight: bold;
		background-color: #006699;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 1px;
		border: 1px solid #EEE;
	
		color: #DDD;
	}
</style>

<?php
function make_pages($page,$limit,$total,$filePath,$otherParams)
{
	// How many adjacent pages should be shown on each side?
	$adjacents = 2;
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	if ($total!=0) { $lastpage = ceil($total/$limit); }		    //lastpage is = total pages / items per page, rounded up.
//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$filePath?page=$prev&$otherParams\">&#171; previous</a>";
		else
			$pagination.= "<span class=\"disabled\">&#171; previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$filePath?page=$counter&$otherParams\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$filePath?page=$counter&$otherParams\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$filePath?page=$lpm1&$otherParams\">$lpm1</a>";
				$pagination.= "<a href=\"$filePath?page=$lastpage&$otherParams\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$filePath?page=1&$otherParams\">1</a>";
				$pagination.= "<a href=\"$filePath?page=2&$otherParams\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$filePath?page=$counter&$otherParams\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$filePath?page=$lpm1&$otherParams\">$lpm1</a>";
				$pagination.= "<a href=\"$filePath?page=$lastpage&$otherParams\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$filePath?page=1&$otherParams\">1</a>";
				$pagination.= "<a href=\"$filePath?page=2&$otherParams\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$filePath?page=$counter&$otherParams\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$filePath?page=$next&$otherParams\">next &#187;</a>";
		else
			$pagination.= "<span class=\"disabled\">next &#187;</span>";
		$pagination.= "</div>\n";		
	}
echo $pagination;	
}
?>	