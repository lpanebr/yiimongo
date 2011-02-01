<?php $this->pageTitle=Yii::app()->name; ?>
<div><?php echo $alert; ?></div>
<h1>Our Clients</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_indexUsers',
        'sortableAttributes'=>array(
            'login',
            'first_name'=>'First Name',
            ),
        'enablePagination'=>true,
));
?>

<ul>
<?php
foreach ($users as $user) {
    echo "<li>{$user->first_name}</li>";
}
?>
</ul>
<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>