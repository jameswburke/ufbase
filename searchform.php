
<?php
	if(is_search()){
		global $query_string;

		$query_args = explode("&", $query_string);
		$search_query = array();

		foreach($query_args as $key => $string) {
			$query_split = explode("=", $string);
			$search_query[$query_split[0]] = urldecode($query_split[1]);

		}
	}
?>

<form class="form-search" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<input type="text" value="<?php echo $search_query['s']; ?>" name="s" id="s" class="input-medium search-query" placeholder="Search"/>
	<input type="submit" id="searchsubmit" value="Search" class="btn" />
</form>