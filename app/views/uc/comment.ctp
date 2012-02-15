<div class="ucRight">
    <div class="head">
      <div class="icon">我的评论</div>
    </div>
	<div class="list">
        <div class="filterTab">
			<div class="filterItem"><?php echo $this->Html->link('百科', '/uc/comment/baike', array('class' => 'red bold'));?></div>		
			<div class="filterItem"><?php echo $this->Html->link('视频', '/uc/comment/video', array('class' => 'bold'));?></div>		
			<div class="div_c"></div>				
		</div>
		<div class="commnetList">
		<?php foreach($list as $num => $item):?>
			<div class="commentItem cur">
				<div class="baike">
					<span class="published">发布于 <?php echo date('m-d H:i', $item['ArticleComment']['created']);?></span>
					<span class="bigIconRed">></span>
					<?php echo $this->Html->link($item['Article']['title'], '/Baike/view/'.$item['Article']['id'], array('target' => '_blank', 'class' => 'red'));?>
				</div>
				<div class="commentDetail"><?php echo $item['ArticleComment']['content']?></div>			
			</div>
		<?php endforeach;?>	
		</div>
    </div>
	<div class="pageShow">
		<?php
		 echo $paginator->first(' 首页 ', null, null);
		 echo "&nbsp;";
		 echo $paginator->prev(' 上一页 ');
					 
		 echo $paginator->numbers(array('separator' => '&nbsp;', 'before' => '&nbsp;', 'after' => '&nbsp;'));
			 
		 echo $paginator->next(' 下一页 ', null, null, array('separator' => ' ', 'before' => ' ', 'after' => ' '));
		 echo "&nbsp;";
					 					 
		 echo $paginator->last(' 末页 ', null, null);
		?>					
	</div> 
</div>