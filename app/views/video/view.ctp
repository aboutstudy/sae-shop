<div class="contentMain">
		<div class="article">
			<div class="titleContent">
				<div class="title"><?php echo $this->data['Video']['title'];?></div>
				<div class="shareButton">
					<span class="shareTitle">收藏分享:</span>
					<span class="sina_weibo">
						<script type="text/javascript" charset="utf-8">
						(function(){
						  var _w = 16 , _h = 16;
						  var param = {
							url:location.href,
							type:'3',
							count:'', /**是否显示分享数，1显示(可选)*/
							appkey:'728177611', /**您申请的应用appkey,显示分享来源(可选)*/
							title:'<?php echo $this->data['Video']['title'];?>', /**分享的文字内容(可选，默认为所在页面的title)*/
							pic:'<?php echo $this->data['VideoWeibo']['img'];?>', /**分享图片的路径(可选)*/
							ralateUid:'1165307924', /**关联用户的UID，分享微博会@该用户(可选)*/
							rnd:new Date().valueOf()
						  }
						  var temp = [];
						  for( var p in param ){
							temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
						  }
						  document.write('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://hits.sinajs.cn/A1/weiboshare.html?' + temp.join('&') + '" width="'+ _w+'" height="'+_h+'"></iframe>')
						})()
						</script>					
					</span>					
					<span class="tencent_weibo">
						<a href="javascript:void(0)" onclick="postToWb();return false;" ><img src="http://v.t.qq.com/share/images/s/weiboicon16.png" align="absmiddle" border="0" alt="转播到腾讯微博" /></a>
						<script type="text/javascript">
							function postToWb(){
								var _t = encodeURI(document.title);
								var _url = encodeURIComponent(document.location);
								var _appkey = encodeURI("appkey");//你从腾讯获得的appkey
								var _pic = encodeURI('<?php echo $this->data['VideoWeibo']['img'];?>');//（例如：var _pic='图片url1|图片url2|图片url3....）
								var _site = 'http://www.doucl.com';//你的网站地址
								var _u = 'http://v.t.qq.com/share/share.php?url='+_url+'&appkey='+_appkey+'&site='+_site+'&pic='+_pic+'&title='+_t;
								window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
							}
						</script>			
					</span>
					<span class="qzone">
					<script type="text/javascript">
						(function(){
						var p = {
						url:location.href,
						desc:'',/*默认分享理由(可选)*/
						summary:'<?php echo $this->data['VideoWeibo']['content'];?>',/*摘要(可选)*/
						title:'<?php echo $this->data['Video']['title'];?>',/*分享标题(可选)*/
						site:'豆壳网',/*分享来源 如：腾讯网(可选)*/
						pics:'<?php echo $this->data['VideoWeibo']['img'];?>' /*分享图片的路径(可选)*/
						};
						var s = [];
						for(var i in p){
						s.push(i + '=' + encodeURIComponent(p[i]||''));
						}
						document.write(['<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?',s.join('&'),'" target="_blank" title="分享到QQ空间"><img src="http://qzonestyle.gtimg.cn/ac/qzone_v5/app/app_share/qz_logo.png" alt="分享到QQ空间" /></a>'].join(''));
						})();
						</script>
					</span>
					<span class="pengyou">
						<script type="text/javascript">
						(function(){
						var p = {
						url:location.href,
						to:'pengyou',
						desc:'',/*默认分享理由(可选)*/
						summary:'<?php echo $this->data['VideoWeibo']['content'];?>',/*摘要(可选)*/
						title:'<?php echo $this->data['Video']['title'];?>',/*分享标题(可选)*/
						site:'豆壳网',/*分享来源 如：腾讯网(可选)*/
						pics:'<?php echo $this->data['VideoWeibo']['img'];?>' /*分享图片的路径(可选)*/
						};
						var s = [];
						for(var i in p){
						s.push(i + '=' + encodeURIComponent(p[i]||''));
						}
						document.write(['<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?',s.join('&'),'" target="_blank" title="分享到腾讯朋友"><img src="http://qzonestyle.gtimg.cn/ac/qzone_v5/app/qzshare/xy-icon.png" alt="分享到腾讯朋友" /></a>'].join(''));
						})();
						</script>										
					</span>
					
				</div>				
				<div class="published">
					<span class="bold">来源：</span><?php echo $this->data['Video']['from'];?> 
					<!-- <span class="bold"> 点击：</span>2088 -->
				</div>
			</div>
			<div class="content">
				<div class="video">
				  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="480" height="400">
                      <param name="movie" value="<?php echo $this->data['Video']['src']?>" />
                      <param name="quality" value="high" />
                      <embed src="<?php echo $this->data['Video']['src']?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="480" height="400"></embed>
				  </object>
				</div>
			</div>
			<div class="video_desc"><?php echo $this->data['VideoDesc']['content'];?></div>
			<div class="categorys">
				<strong>分类：</strong>
				<?php foreach($this->data['Category'] as $category):?>
					<?php echo $this->Html->link($category['title'], '/video/search/category:' . $category['title']);?>					
				<?php endforeach;?>
			</div>			
			<div class="tags">
				<strong>标签：</strong>
				<?php foreach($this->data['Tag'] as $tag):?>
					<?php echo $this->Html->link($tag['title'], '/video/search/tag:' . $tag['title']);?>					
				<?php endforeach;?>
			</div>
			<!-- 相关视频 -->
			<?php echo $this->element('relationVideo');?>			
		</div>		
	    <div class="weibo">
		 <div class="expert">
			<div class="img">
				<?php echo $this->Html->link($this->Html->image($this->data['User']['myface'], array('width' => 65, 'alt' => $this->data['User']['username'])), '/weibo/toWeibo/'.$this->data['VideoWeibo']['uid'].'/'.$this->data['VideoWeibo']['sid'], array('escape' => false, 'target' => '_blank'));?>					
			</div>
			<div class="published">
				<span class="time">发布于  <?php echo date('m月d日 H:i', $this->data['VideoWeibo']['created']);?></span>				
				<div class="red bold">
					<?php echo $this->Html->link($this->data['User']['username'], '/weibo/toWeibo/'.$this->data['VideoWeibo']['uid'].'/'.$this->data['VideoWeibo']['sid'], array('class' => 'red bold', 'target' => '_blank'));?>
				</div>
			</div>
			<div class="content">
				<?php echo $this->data['VideoWeibo']['content'];?>
				<?php echo $this->Html->link('[马上关注]', '/weibo/toWeibo/'.$this->data['VideoWeibo']['uid'].'/'.$this->data['VideoWeibo']['sid'], array('class' => 'red', 'target' => '_blank'));?> 
			</div>
	  		<div class="div_c"></div>
	     </div>
	     <div class="commentInput">
	  	 	<div class="top">&nbsp;</div>
			<div class="formBody">
				<?php echo $this->Html->div('submitButton', '&nbsp;', array('mid' => $this->data['Video']['id'], 'sType' => 'video'));?>
				<?php echo $this->Html->div('small', '&nbsp;');?>
				<?php echo $this->Form->input('Comment.text', array('label' => false, 'type' => 'text', 'div' => 'textInput'));?>
				<div class="div_c"></div>
				<div class="options">
					<?php echo $this->Form->input('isRepost', array('type' => 'checkbox', 'label' => '同时转发到我的微博'));?>
					
					<?php echo $this->Form->input('isFollow', array('type' => 'checkbox', 'label' => '关注 '.$this->data['User']['username']));?>
					<?php echo $this->Form->hidden('VideoWeibo.sid');?>
					<?php echo $this->Form->hidden('Video.id');?>
					<?php echo $this->Form->hidden('VideoWeibo.uid');?>
				</div>					
			 </div>
	  		<div class="bottom">&nbsp;</div>
	  	  </div>
		  <div class="replyList">
				<!-- 回评列表开始 -->
				<?php foreach($commentList as $item):?>
				<div class="reply">
					<div class="img">
						<?php
							$item['User']['myface'] = empty($item['User']['myface']) ? '/images/default_face.jpg' : $item['User']['myface']; 
							echo $this->Html->link($this->Html->image($item['User']['myface'], array('width' => 50, 'height' => 50, 'alt' => $item['User']['username'])), 'http://weibo.com/n/' . $item['User']['username'], array('target' => '_blank', 'escape' => false));
						?>
					</div>
					<div class="contentBody">
						<div class="pointer">&nbsp;</div>
						<div class="published">
							<span class="time">发布于 <?php echo date('m月d日 H:i', $item['VideoComment']['created']);?></span>				
							<div class="red bold"><?php echo $item['User']['username']?></div>
						</div>
						<div class="content"><?php echo $item['VideoComment']['content']?></div>
					</div>
					<div class="div_c"></div>
				</div>			
				<?php endforeach;?>	
				<!-- 回评列表结束 -->
				<div class="pageShow alignRight"> <span><a  href="#">上一页</a></span> <span><a  href="#">1</a></span> <span><a  href="#">2</a></span> <span><a  href="#">下一页</a></span> </div>
			</div>
		</div>
		<div class="div_c"></div>
	</div>