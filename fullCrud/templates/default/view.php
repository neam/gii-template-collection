<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'Update <?php echo $this->modelClass; ?>', 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'Delete <?php echo $this->modelClass; ?>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<h1>View <?php echo $this->modelClass." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>


<?php
	foreach(CActiveRecord::model($this->model)->relations() as $key => $relation)	
{
	if($relation[0] == 'CManyManyRelation') 
	{
		$columns = CActiveRecord::model($relation[1])->tableSchema->columns;
		next($columns);

		$suggestedtitle = current($columns); 

		printf("<br /><h2> This %s belongs to this %s: </h2>\n", $relation[1], $this->modelClass);
		echo CHtml::openTag('ul');
		printf("<?php foreach(\$model->%s as \$foreignobj) { \n
				printf('<li>%%s</li>', \$foreignobj->%s);\n
				} ?>", $key, $suggestedtitle->name); 
		echo CHtml::closeTag('ul');
	}
}
?>