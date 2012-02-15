<?php
class UsersController extends AppController{
	var $uses = array('User', 'Sina', 'Help', 'MallCart', 'Qzone');
	
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('reg', 'oAuthResponse', 'accountBond', 'login', 'bondQzone', 'toQzoneConnect', 'qzoneResponse');
		$this->set('title_for_layout', '会员');
	}
	
	public function beforeRender(){
//		计算购物车中商品数量 		
//		$cart_count = $this->MallCart->find('count', array('conditions' => array('MallCart.session_id' => session_id())));
//		$this->set('cart_count', $cart_count);		
	}
		
	public function login(){
		$user = $this->Auth->user();
		if(empty($user)){
			//清空RequestToken
			$this->Session->delete('sina');
			
			App::import('Vendor', 'weibooauth');
			$oAuth = new WeiboOAuth(WB_AKEY, WB_SKEY);
			$requestToken = $oAuth->getRequestToken();
			
			$this->Session->write('sina.requestToken', $requestToken);
			$aurl = $oAuth->getAuthorizeURL($requestToken['oauth_token'], false, "http://".$_SERVER['HTTP_HOST']."/users/oAuthResponse/");
			$this->set('aurl', $aurl);
			$this->set('title_for_layout', '会员登陆');
				
			//获取帮助文档
//			$helpList = $this->Help->findAllByHelpTypeId(1);
			$helpList = $this->Help->getOthers(1);
			$this->set('helpList', $helpList);			
		}
		else{
			//刷新会员绑定账号信息，更新AccessToken
			
			$this->redirect('/uc/');
		}
	}
	
	/**
	 * 微博连接响应
	 */
	public function oAuthResponse(){
		if(isset($_REQUEST['oauth_verifier'])){
			App::import('Vendor', 'weibooauth');
		
			$requestToken = $this->Session->read('sina.requestToken');					
			$oAuth = new WeiboOAuth(WB_AKEY, WB_SKEY, $requestToken['oauth_token'], $requestToken['oauth_token_secret']);
			
			$accessToken = $oAuth->getAccessToken($_REQUEST['oauth_verifier']);
					
			//绑定判断
			if(isset($accessToken)){
				$this->Session->write('sina.accessToken', $accessToken);
				$user = $this->User->find('first', array('conditions' => array('Sina.uid' => $accessToken['user_id'])));
				if(empty($user)){
					//进入绑定流程
					$this->redirect('/users/accountBond/sina');
				}
				else{
					//完成登陆
					$this->Auth->login($user);
					$this->redirect('/uc/');
				}				
			}
			else{
				$this->flash('授权失败！', '/index/index');	
			}			
		}
		else{
			$this->flash('授权失败！', '/index/index');
		}
	}
	
	/**
	 * 退出登陆
	 */
	public function loginOut(){
		$this->Session->delete('sina');
		$this->redirect($this->Auth->logout());
	}
	
	/**
	 * 会员注册
	 */
	public function reg(){					
		if(empty($this->data)){
			$user = $this->Auth->user();
			if(!empty($user)){
				$this->redirect('/uc/');
			}
			else{
				//清空RequestToken
				$this->Session->delete('sina');
				
				App::import('Vendor', 'weibooauth');
				$oAuth = new WeiboOAuth(WB_AKEY, WB_SKEY);
				$requestToken = $oAuth->getRequestToken();
				
				$this->Session->write('sina.requestToken', $requestToken);
				$aurl = $oAuth->getAuthorizeURL($requestToken['oauth_token'], false, "http://".$_SERVER['HTTP_HOST']."/users/oAuthResponse/");
				$this->set('aurl', $aurl);			

				//获取帮助文档
//				$helpList = $this->Help->findAllByHelpTypeId(1);
				$helpList = $this->Help->getOthers(1);
				$this->set('helpList', $helpList);
				
				$this->set('title_for_layout', '注册会员');	
			}				
		}
		else{
			$this->data['User']['email'] = trim($this->data['User']['email']);
			
			//检验邮箱是否已经注册
			$hasReg = $this->User->find('count', array('conditions' => array('User.email' => $this->data['User']['email'])));
			if(empty($hasReg)){
				if($this->User->save($this->data)){
					$this->Auth->login($this->data);
					$this->flash('恭喜注册成功,下一步"完善资料"！', '/Users/setting/');
				}	
				else{
					$this->flash('注册失败');
				}	
			}
			else{
				$this->flash('邮箱已经被注册！', '/Users/reg/', 2);				
			}			
		}			
	}
	
	public function accountBond($openType = 'sina'){
		//获取帮助文档
		$helpList = $this->Help->getOthers(1);
		$this->set('helpList', $helpList);
				
		if($openType == 'sina'){
			if(empty($this->data)){
				App::import('Vendor', 'weibooauth');
				$accessToken = $this->Session->read('sina.accessToken');
				$sClient = new WeiboClient(WB_AKEY, WB_SKEY, $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
				
				//获取微博用户资料
				$weibo = $sClient->verify_credentials();
				$this->data = array(
					'User' => array(
						'username' => $weibo['name'],
						'myface' => $weibo['profile_image_url'],
					),
					'Sina' => array(
						'oauth_token' => $accessToken['oauth_token'],
						'oauth_token_secret' => $accessToken['oauth_token_secret'],
						'uid' => $weibo['id'],					
						'screen_name' => $weibo['screen_name'],					
						'description' => $weibo['description'],
						'profile_image_url' => $weibo['profile_image_url'],
						'followers_count' => $weibo['followers_count'],
						'friends_count' => $weibo['friends_count'],
						'statuses_count' => $weibo['statuses_count'],
						'verified' => $weibo['verified']
					)
				);			
			}
			else{
				//判断邮箱是否已经注册
				
				//注册新会员账号
				if($this->User->save($this->data)){
					$this->data['Sina']['member_id'] = $this->User->id;					
					if($this->Sina->save($this->data['Sina'])){
						$this->flash('绑定操作成功！', '/uc/');
						$this->Auth->login($this->data['User']);	
					}
				}
				else{
					echo '保存失败'; exit;
				}
				//保存绑定信息
			}			
		}
		elseif($openType == 'qzone'){
			if(empty($this->data)){
				App::import('Vendor', 'qzone/qzone_service');
				$qzoneService = new QzoneService();
				$qzoneConfig = $this->Qzone->getConfig();
				
				$accessToken = $this->Session->read('qzone.accessToken');
								
				//获取微博用户资料
				$qzone = $qzoneService->get_user_info($qzoneConfig["appid"], $qzoneConfig["appkey"], $accessToken['oauth_token'], $accessToken['oauth_token_secret'], $accessToken['openid']);
				$this->data = array(
					'User' => array(
						'username' => $qzone['nickname'],
						'myface' => $qzone['figureurl_2'],
					),
					'Qzone' => array(
						'oauth_token' => $accessToken['oauth_token'],
						'oauth_token_secret' => $accessToken['oauth_token_secret'],
						'nickname' => $qzone['nickname'],
						'openid' => $accessToken['openid'],		
						'figureurl' => $qzone['figureurl_2']
					)
				);	
				$this->render('/users/qzone_bond');		
			}
			else{
				//判断邮箱是否已经注册
				
				//注册新会员账号
				if($this->User->save($this->data)){
					$this->data['Qzone']['member_id'] = $this->User->id;					
					if($this->Qzone->save($this->data['Qzone'])){
						$this->flash('绑定操作成功！', '/uc/');
						$this->Auth->login($this->data['User']);	
					}
				}
				else{
					echo '保存失败'; exit;
				}
				//保存绑定信息
			}			
//			$userInfo = $qzoneService->get_user_info($qzoneConfig["appid"], $qzoneConfig["appkey"], $accessToken['oauth_token'], $accessToken['oauth_token_secret'], $accessToken['openid']);
//			print_r($userInfo);		
//			exit;
		}
		else{
			$this->flash('错误的认证类型！', '/users/reg/');
		}		
	}
	//账号设置
	public function setting(){
		if(empty($this->data)){
			$user = $this->Auth->user();		
			$this->User->recursive = -1;
			$this->User->id = $user['User']['id'];
			$this->data = $this->User->read();
			$this->data['User']['myface'] = empty($this->data['User']['myface']) ? '/images/default_face.jpg' : $this->data['User']['myface'];		
			unset($this->data['User']['password']);	
		}
		else{
			//判断密码是否为空，为空则不修改密码。因为CakePHP的Auth组件会在这之前自动密码密码
			//字符串"7e69e1849eca3d3ef00e0eec4c712481e358b9e8"实际为“空”经过加密后结果
			if ($this->data['User']['password'] == $this->Auth->password('')){				
				unset($this->data['User']['password']);
			}
			
			if($this->User->save($this->data)){
				//更新会员登陆信息
				$this->Session->write('Auth.User.username', $this->data['User']['username']);
				$this->flash('修改资料成功', '/users/setting', 2);	
			}
			else{
				$this->flash('修改资料失败', '/users/setting', 2);
			}
		}
		$this->set('title_for_layout', '修改资料');
		$this->layout = 'uc';		
	}	
	
	//绑定微博账号
	public function bondWeibo(){		
		$user_id = $this->Auth->user('id');
		$this->User->recursive = 0;
		$user = $this->User->findById($user_id);
		if(!empty($user['Sina']['uid'])){
			$this->flash('您已经绑定过微博账号！', '/uc/');
		}
		else{
			//清空RequestToken
			$this->Session->delete('sina');			
			App::import('Vendor', 'weibooauth');
			$oAuth = new WeiboOAuth(WB_AKEY, WB_SKEY);
			$requestToken = $oAuth->getRequestToken();
			
			$this->Session->write('sina.requestToken', $requestToken);
			$aurl = $oAuth->getAuthorizeURL($requestToken['oauth_token'], false, "http://".$_SERVER['HTTP_HOST']."/users/oAuthResponse/");
			
	//		$this->set('aurl', $aurl);				
	//		$this->set('title_for_layout', '绑定微博');
	//		$this->layout = 'uc';
			$this->flash('进入微博授权页面', $aurl, 2);		
		}
	}
	
	public function setMyface(){		
		$this->User->id = $this->Auth->user('id');
		if($this->User->saveField('myface', $this->params['url']['myface'])){
			$response = array('msg' => '上传成功啦', 'error' => 0);
		}
		else{
			$response = array('msg' => '上传失败', 'error' => 1);
		}		
		
		echo json_encode($response);
		
		$this->autoRender = false;
	}
	
	public function toQzoneConnect(){
		App::import('Vendor', 'qzone/qzone_service');
		$qzoneService = new QzoneService();
		$qzoneConfig = $this->Qzone->getConfig();		
		
	    //跳转到QQ登录页的接口地址, 不要更改!!
	    $redirect = "http://openapi.qzone.qq.com/oauth/qzoneoauth_authorize?oauth_consumer_key=".$qzoneConfig['appid']."&";
	
	    //调用get_request_token接口获取未授权的临时token
	    $result = array();
	    $request_token = $qzoneService->get_request_token($qzoneConfig['appid'], $qzoneConfig['appkey']);
	    parse_str($request_token, $result);
	    
	    //request token, request token secret 需要保存起来
	    //在demo演示中，直接保存在全局变量中.
	    //为避免网站存在多个子域名或同一个主域名不同服务器造成的session无法共享问题
	    //请开发者按照本SDK中comm/session.php中的注释对session.php进行必要的修改，以解决上述2个问题，
//	    $_SESSION["token"]        = $result["oauth_token"];
//	    $_SESSION["secret"]       = $result["oauth_token_secret"];
	    
	    $this->Session->write("qzone.token", $result["oauth_token"]);
	    $this->Session->write("qzone.secret", $result["oauth_token_secret"]);
	
	    if ($result["oauth_token"] == "")
	    {
	        //示例代码中没有对错误情况进行处理。真实情况下网站需要自己处理错误情况
	        exit;
	    }
	
	    ////构造请求URL
	 	$redirect .= "oauth_token=".$result["oauth_token"]."&oauth_callback=".rawurlencode($qzoneConfig['callback']);	 	
	    //header("Location:$redirect");
	    $this->redirect($redirect);	
	    $this->autoRender = false;
	}
	
	public function qzoneResponse(){		
		App::import('Vendor', 'qzone/qzone_service');
		$qzoneService = new QzoneService();
		$qzoneConfig = $this->Qzone->getConfig();
		
		$accessReturn = $qzoneService->get_access_token($qzoneConfig["appid"], $qzoneConfig["appkey"], $_REQUEST["oauth_token"], $_SESSION['qzone']["secret"], $_REQUEST["oauth_vericode"]);
		$accessToken = array();
		parse_str($accessReturn, $accessToken);
		
		if(empty($accessToken)){
			$this->flash('QQ授权失败', '/Users/login', 3);
		}
		else{			
			//记录授权信息AccessToken
			$this->Session->write('qzone.accessToken', $accessToken);
			/*
			$this->Session->write('qzone.oauth_token', $accessToken['oauth_token']);
			$this->Session->write('qzone.oauth_token_secret', $accessToken['oauth_token_secret']);
			$this->Session->write('qzone.oauth_signature', $accessToken['oauth_signature']);
			$this->Session->write('qzone.openid', $accessToken['openid']);
			$this->Session->write('qzone.timestamp', $accessToken['timestamp']);
			*/
			
			$user = $this->User->find('first', array('conditions' => array('Qzone.openid' => $accessToken['openid'])));
			if(empty($user)){
				//进入绑定流程
				$this->redirect('/users/accountBond/qzone');
			}
			else{
				//完成登陆
				$this->Auth->login($user);
				$this->redirect('/uc/');
			}			

			//进入账号绑定页面
		}		
	}
	public function bondQzone(){
		print_r($_SESSION);
		print_r($this->params);
		exit;
	}	
}