<?php
	$_model = array();
	foreach($model as $data)
	{
		$_model[] = array('id' => intval($data->id), 'Name' => $data->Name, 'Frequency' => intval($data->Frequency));
	}
	
	$desc = array();
	foreach($this->array_sort($_model, 'Frequency', SORT_DESC) as $data)
	{
		$desc[] = $data;
	}
?>

<?php foreach($desc as $tag): ?>
	<a href="search?tag=<?php echo $tag['Name']; ?>"><?php echo $tag['Name']; ?></a>
	<span></span>
<?php endforeach; ?>