<?php
class Tag extends AppModel{
	var $name = 'Tag';
	var $hasAndBelongsToMany = array(
		'Article' => array(
			'className'		 => 'Article',
			'joinTable'		 => 'articles_tags',
			'foreignKey'	 => 'tag_id',
			'associationForeignKey'	=> 'article_id'
		),
		'Video' => array(
			'className'		 => 'Video',
			'joinTable'		 => 'videos_categorys',
			'foreignKey'	 => 'category_id',
			'associationForeignKey'	=> 'video_id'
		)
	);
	
	/**
	 * 给出一个字符串，查询标签ID，无该标签则添加新标签
	 * @param unknown_type $strTags
	 */
	public function checkAdd($strTags){
		$arrTags = explode(' ', $strTags);
		$arrTagsID = array();
		foreach ($arrTags as $key => $tag){
			$tag = trim($tag);
			if(empty($tag)){
				unset($arrTags[$key]);
			}
			else{
				$tag_id = $this->field('id', array('Tag.title' => $tag));
				$data = '';
				if(empty($tag_id)){
					$this->create();
					$data['Tag']['title'] = $tag;
					$this->save($data);
					$tag_id = $this->id;					
					$arrTagsID[] = $tag_id;
				}
				else{
					$arrTagsID[] = $tag_id;
				}
			}
		}	
		return $arrTagsID;	
	}
}