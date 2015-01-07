<?php
$this->pageTitle=$_GET['title'];
?>

<?php $this->renderPartial('_view', array(
	'data'=>$model,
)); ?>