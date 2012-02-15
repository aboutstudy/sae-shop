<?php
echo $paginator->first(' 首页 ', null, null);
echo "&nbsp;";
echo $paginator->prev(' 上一页 ');
echo "&nbsp;";					 
echo $paginator->numbers(array('separator' => '&nbsp;', 'before' => '&nbsp;', 'after' => '&nbsp;'));
echo "&nbsp;";					 
echo $paginator->next(' 下一页 ', null, null, array('separator' => ' ', 'before' => ' ', 'after' => ' '));
echo "&nbsp;";					 					 
echo $paginator->last(' 末页 ', null, null);
?>