<!-- Equals to
<form method="post">
	<input type="number" name="input" class="form-control">
	<input type="submit" value="send" class="btn btn-default">
</form>
 -->

<?php echo CHtml::beginForm('', 'post'); ?>
	<?php echo CHtml::numberField('input', '', array('class'=>'form-control')); ?>
	<?php echo CHtml::submitButton('send', array('class'=>'btn btn-default')); ?>
<?php echo CHtml::endForm(); ?>

<?php if(Yii::app()->user->hasFlash('test')): ?>
	<div id="test" class="well">
		<p style="word-wrap:break-word">
			<?php echo Yii::app()->user->getFlash('test'); ?>
		</p>
	</div>
<?php endif; ?>