<?php
$this->widget('zii.widgets.ClistView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
	'emptyText'=>'No task found'
));
?>