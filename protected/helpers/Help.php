<?php
class Help {
	/**
	 * _curl
	 * @param  $api
	 * @return mixed
	 */
	public static function _curl($api){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$rep = curl_exec($ch);
		curl_close($ch);
		//curl 错误
		if($rep === false){
	
		}
		return $rep;
	}
	
	//生成salt
	public static function fetchSalt($n=4){
		$salt='';
		for ($i=0; $i < $n; $i++) {
			$salt.=chr(rand(97,122));
		}
		return $salt;
	}
	
	/**
	 * 对内容进行过滤  未使用
	 */
	public static function htmlPurifier($content){
		$p = new CHtmlPurifier();
		//过滤规则
		$p->options = array(
				'URI.Disable'=>true,
		);
		return $p->purify($content);
	}

	/**
	 * 处理头像上传
	 * 成功返回 头像文件否则返回false
	 */
	public static function uploadAvatar($uid,$fieldName){
		$file=CUploadedFile::getInstanceByName($fieldName);
		if(is_object($file) && get_class($file)){
			//保存原图像
			//后缀名
			$extensionName=$file->getExtensionName();
			//文件名  id.jpg
			if(!in_array($extensionName, Yii::app()->params['image_extension'])){
				$this->error('上传的文件名不合法');
			}		
			//save   /public/upload/avatar/1/1.jpg
			$fileName = $uid.'_origin.'.$extensionName;
			$avatarDir='public/upload/avatar/'.$uid;
			if(!is_dir($avatarDir)){
				mkdir($avatarDir,0777);
			}
			$avatarName=$avatarDir.'/'.$fileName;
			if(!$file->saveAs($avatarName)){
				$this->error('头像上传失败');
			}

			//将图片进行处理
			//载入 扩展
			Yii::import('application.extensions.image.Image');
			$image = new Image($avatarName);
			$image->resize(50,50);
			$avatar_50=$avatarDir.'/'.$uid.'_50.'.$extensionName;
			if(!$image->save($avatar_50)){
				$this->error('头像处理失败');
			}

			//保存 width =180
			$image->resize(180,180);
			$avatar_180=$avatarDir.'/'.$uid.'_180.'.$extensionName;
			if(!$image->save($avatar_180)){
				$this->error('头像处理失败');
			}				
			unset($image);
			//保存头像  用绝对路径
			return '/'.$avatar_50;
		}else{
			return false;
		}
	}
}

?>