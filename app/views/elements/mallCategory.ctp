			<div class="region">
				<div class="top red bold">宝贝分类</div>
				<div class="content">
					<div class="sortList">
					<?php foreach($catTypeList as $num => $catType):?>
					  <?php if($num == 0):?>
						<div class="item">
							<div class="topSort"><?php echo $this->Html->link($catType['MallCatType']['title'], array('controller' => 'Goods', 'action' => 'search', 'cat_type' => $catType['MallCatType']['title']));?></div>
							<div class="subSort">
							<?php foreach($catType['MallCategory'] as $snum => $category):?>
								<?php if($snum >= 4): break; endif;?>
								<div class="sort"><?php echo $this->Html->link($category['title'], array('controller' => 'Goods', 'action' => 'search', 'category' => $category['title']), array('class' => $category['flags']));?></div>						
							<?php endforeach;?>							
							</div>
							<div class="wholeList">								
								<?php foreach($catType['MallCategory'] as $cnum => $category):?>
									<div class="sort"><?php echo $this->Html->link($category['title'], array('controller' => 'Goods', 'action' => 'search', 'category' => $category['title']), array('class' => $category['flags']));?></div>						
								<?php endforeach;?>																												
							</div>
							<div class="mask">&nbsp;</div>						
						</div>
						<div class="div_c"></div>		
					  <?php else:?>						
						<div class="item">
							<div class="topSort"><?php echo $this->Html->link($catType['MallCatType']['title'], array('controller' => 'Goods', 'action' => 'search', 'cat_type' => $catType['MallCatType']['title']));?></div>
							<div class="subSort">
								<?php foreach($catType['MallCategory'] as $snum => $category):?>
									<?php if($snum >= 4): break; endif;?>
									<div class="sort"><?php echo $this->Html->link($category['title'], array('controller' => 'Goods', 'action' => 'search', 'category' => $category['title']), array('class' => $category['flags']));?></div>						
								<?php endforeach;?>							
							</div>
							<div class="wholeList">
								<?php foreach($catType['MallCategory'] as $cnum => $category):?>
									<div class="sort"><?php echo $this->Html->link($category['title'], array('controller' => 'Goods', 'action' => 'search', 'category' => $category['title']), array('class' => $category['flags']));?></div>						
								<?php endforeach;?>																																					
							</div>
							<div class="mask">&nbsp;</div>							
						</div>
						<div class="div_c"></div>										
					  <?php endif;?>	
					<?php endforeach;?>										
					</div>
				</div>
				<div class="bottom"></div>			
			</div>