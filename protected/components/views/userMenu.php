<ul>
    <li><?php echo CHtml::link('Create new Post',array('post/create')); ?></li>
    <li><?php echo CHtml::link('Create new Category',array('category/create')); ?></li>
    <li><?php echo CHtml::link('Manage Posts',array('post/admin')); ?></li>
    <li><?php echo CHtml::link('Manage Category',array('category/admin')); ?></li>
    <li><?php echo CHtml::link('Approving Сomments',array('comment/index'))
        . ' (' . Comment::model()->pendingCommentCount . ')'; ?></li>
    <li><?php echo CHtml::link('Logout',array('site/logout')); ?></li>
</ul>