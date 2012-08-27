<div id="menu">
    <ul class="menu">
        <!-- ROOT -->
        <?php foreach ($roots as $root): ?>
            <li><a href="<?php echo Yii::app()->baseUrl.'/'.$root->link;?>" class="parent"><?php echo $this->generateSpan($root);?></a>
                <!-- SET INVISIBLE IF DON'T HAVE CHILD -->
                <?php if($this->getChild($root->id)):?>
                <ul>
                    <!-- FIRST CHILD -->
                    <?php foreach ($this->getChild($root->id) as $children): ?>
                        <li><a href="<?php echo Yii::app()->baseUrl.'/'.$children->link;?>" class="parent"><?php echo $this->generateSpan($children);?></a>                            
                            <ul>
                                <!-- SECOND CHILD -->
                                <?php foreach ($this->getChild($children->id) as $children): ?>
                                    <li><a href="<?php echo Yii::app()->baseUrl.'/'.$children->link;?>" class="parent"><?php echo $this->generateSpan($children);?></a>                                        
                                        <ul>
                                            <!-- THIRD CHILD -->
                                            <?php foreach ($this->getChild($children->id) as $children): ?>
                                                <li><a href="<?php echo Yii::app()->baseUrl.'/'.$children->link;?>" class="parent"><?php echo $this->generateSpan($children);?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>                                 
                                    </li>
                                <?php endforeach; ?>
                            </ul>                            
                        </li>   
                    <?php endforeach; ?>
                </ul>
                <?php endif;?>
            </li>        
        <?php endforeach; ?>
    </ul>
</div>
<a href="http://apycom.com/"></a>