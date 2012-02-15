<?php
class MallConsignee extends AppModel{
	var $name = 'MallConsignee';
	var $useTable = 'mall_consignees';
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);
	
	public function getList($user_id){
		$this->recursive = -1;
		$list = $this->find('all', array('conditions' => array('MallConsignee.user_id' => $user_id), 'limit' => 5, 'order' => array('MallConsignee.id' => 'DESC')));
		
		//处理将区域标识替换为文字
		foreach($list as $num => $item){
			$sql = "SELECT `region_name` FROM `mall_regions` WHERE 1=1 AND `id`=" . $item['MallConsignee']['province'] . " LIMIT 1";
			$province = $this->query($sql);			
			$list[$num]['MallConsignee']['province'] = $province[0]['mall_regions']['region_name'];
			
			$sql = "SELECT `region_name` FROM `mall_regions` WHERE 1=1 AND `id`=" . $item['MallConsignee']['city'] . " LIMIT 1";
			$city = $this->query($sql);			
			$list[$num]['MallConsignee']['city'] = $city[0]['mall_regions']['region_name'];

			$sql = "SELECT `region_name` FROM `mall_regions` WHERE 1=1 AND `id`=" . $item['MallConsignee']['district'] . " LIMIT 1";
			$district = $this->query($sql);			
			$list[$num]['MallConsignee']['district'] = $district[0]['mall_regions']['region_name'];			
		}
		return $list;
	}
	
	public function getRegionName($region_id){
		$sql = "SELECT `region_name` FROM `mall_regions` WHERE 1=1 AND `id`=" . $region_id . " LIMIT 1";
		$region = $this->query($sql);			
		$return = $region[0]['mall_regions']['region_name'];

		return $return;
	}
	/**
	 * 返回历史收件信息
	 * @param unknown_type $consignee_id
	 */
	public function getHistory($consignee_id){
		$result = $this->findById($consignee_id);
		return $result;
	}	
}