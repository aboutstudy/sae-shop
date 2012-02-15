<div class="page">
	<?php
     echo $paginator->counter(array('format' => '<span>共 %count% 条记录 </span><span>第 %page%/%pages% 页</span> '));
	 echo $paginator->first(' 首页', null, null);
	 echo $paginator->prev(' 上一页', null, null);
	 echo $paginator->numbers(array('separator' => ' ', 'before' => '', 'after' => ''));
	 echo $paginator->next(' 下一页', null, null);
	 echo $paginator->last(' 末页', null, null);
	?>
</div>