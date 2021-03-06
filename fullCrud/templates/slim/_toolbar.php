<div class="btn-toolbar">
    <div class="btn-group">
        <?php
        echo '<?php  ?>';
        echo '<?php
            switch($this->action->id) {
                case "admin":
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>"Create",
                        "icon"=>"icon-plus",
                        "url"=>array("create")
                    ));
                    break;
                case "view":
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>"Manage",
                        "icon"=>"icon-list-alt",
                        "url"=>array("admin")
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>"Update",
                        "icon"=>"icon-edit",
                        "url"=>array("update","id"=>$model->id)
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>"Delete",
                        "type"=>"danger",
                        "icon"=>"icon-remove icon-white",
                        "htmlOptions"=> array(
                            "submit"=>array("delete","id"=>$model->id),
                            "confirm"=>"Do you want to delete this item?")
                         )
                    );
                    break;
                case "update":
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>"Manage",
                        "icon"=>"icon-list-alt",
                        "url"=>array("admin")
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>"View",
                        "icon"=>"icon-eye-open",
                        "url"=>array("view","id"=>$model->id)
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>"Delete",
                        "type"=>"danger",
                        "icon"=>"icon-remove icon-white",
                        "htmlOptions"=> array(
                            "submit"=>array("delete","id"=>$model->id),
                            "confirm"=>"Do you want to delete this item?")
                         )
                    );
                    break;
            }
        ?>';
        ?>
    </div>
    <?php echo "<?php if(\$this->action->id == 'admin'): ?>" ?>
    <div class="btn-group">
        <?php echo '<?php
    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>"Search",
                        "icon"=>"icon-search",
                        "htmlOptions"=>array("class"=>"search-button")
                    ));?>'; ?>
    </div>

    <div class="btn-group">
        <?php
        echo "<?php \$this->widget('bootstrap.widgets.TbButtonGroup', array(
        'buttons'=>array(
                array('label'=>'Relations', 'icon'=>'icon-search', 'items'=>array(";

        // render relation links
        $model = new $this->modelClass;
        #echo "<div class='btn-toolbar'>";
        foreach ($model->relations() AS $key => $relation) {
            echo "array('label'=>'{$relation[1]}', 'url' =>array('{$this->codeProvider->resolveController($relation)}/admin')),";
            #Yii::t("app", substr(str_replace("Relation", "", $relation[0]), 1)) . " " .
        }

        echo "
            )
          ),
        ),
    ));
?>";
        ?>

        <ul class="dropdown-menu">
            <?php
// render relation links
            $model = new $this->modelClass;
            #echo "<div class='btn-toolbar'>";
            foreach ($model->relations() AS $key => $relation) {
                echo "<li>";
                echo '<?php echo CHtml::link(
        Yii::t("app", "' . $relation[1] . '"),
        array("' . $this->codeProvider->resolveController($relation) . '/admin")) ?>';
                echo " </li>\n";
                #Yii::t("app", substr(str_replace("Relation", "", $relation[0]), 1)) . " " .
            }
            #echo "</div>";
            ?>
        </ul>
    </div>

    <?php echo "<?php endif; ?>" ?>
</div>

<div class="search-form" style="display:none">
    <?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div>