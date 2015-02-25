<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    public function getMenuItems() {
       $blockQuery = Block::model()->findAll();
       $categoryQuery = Category::model()->findAll();
       foreach($blockQuery as $block){
        echo '<li class="onelink"><a href="#"><span>'.$block->name.'</span></a><ul class="menuLi">';
           foreach($categoryQuery as $cat){
            if($block->id==$cat->id_block){
                echo '<li><a href="/category/'.$cat->id.'/'.$cat->name.'">'.$cat->name.'</a></li>';
                }
               }
               echo '</ul>';
              }
    }
}
