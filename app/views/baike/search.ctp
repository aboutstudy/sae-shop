<div class="homeMain">
		<div class="mainLeft">
		  <div class="baikeList">		  	
			<div class="listTitle">
				<div class="icon">搜索结果</div>
				<div class="conditions"><?php echo $keyword;?> </div>
			</div>			
			<div class="list">
			   	<ul>
					<?php foreach($list as $item):?>
					<li class="baikeShow">
						<div class="author">
							<?php echo $this->Html->link($this->Html->image($item['User']['myface'], array('width' => 51, 'height' => 51, 'alt' => $this->data['Article']['title'])), '/baike/view/'.$item['Article']['id'], array('escape' => false, 'target' => '_blank'));?>							
						</div>
						<div class="title">
							<span class="published"><?php echo date('m月d日 H:i', $item['ArticleWeibo']['created']);?></span>
							<?php echo $this->Html->link($item['Article']['title'], '/baike/view/'.$item['Article']['id'], array('target' => '_blank'));?>
						</div>
						<div class="weibo"><?php echo $this->Html->link($item['ArticleWeibo']['content'], '/baike/view/'.$item['Article']['id'], array('target' => '_blank'));?></div>
					</li>			
					<?php endforeach;?>											
				</ul>
			    <div class="div_c"></div>
				<div class="pageShow alignCenter">
					<!-- <span><a  href="#">上一页</a></span> <span><a  href="#">1</a></span> <span><a  href="#">2</a></span> <span class="current">3</span> <span><a  href="#">4</a></span> <span><a  href="#">下一页</a></span> -->
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
		  </div>
	  </div>
		<div class="sidebar">
			<!--会员展示-->
			<?php echo $this->element('hotUser');?>
			<!-- 百科标签、分类 -->
			<?php echo $this->element('tagsIndexForBaike');?>
			<!--热门、最新视频列表 -->
			<?php echo $this->element('videoTop10');?>
		</div>
		<div class="div_c"></div>
	</div>