<?php 
$this->beginWidget('CMarkdown', array('purifyOutput'=>true));

foreach($data as $post){
    echo '<div class="post">';
    echo '<div class="title">'.CHtml::link(CHtml::encode($post->title), $post->url).'</div>';
    echo '<div class="content">'.$post->content.'</div>';
    echo '</div>';
}

$this->endWidget();
?>