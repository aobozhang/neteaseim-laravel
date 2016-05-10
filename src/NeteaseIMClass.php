<?php
namespace Aobo\Neteaseim;
use Cache;

class NeteaseimClass
{
	protected $appkey;
	protected $appsecret;
	protected $url;

//------------------------------------------------------用户体系
	/**
	 * 初始化参数
	 *
	 * @param array $options
	 * @param $options['appkey']
	 * @param $options['appsecret']
	 */
	public function __construct($options) {
		$this->appkey    = isset ( $options ['appkey'] ) ? $options ['appkey'] : '';
		$this->appsecret = isset ( $options ['appsecret'] ) ? $options ['appsecret'] : '';
		$this->url       = 'https://api.netease.im/';
	}


	/**
	 * user 相关接口
	 */

	/**
	 * 创建云信id
	 * @param  array $option 包含创建id的参数：accid,name,props,icon,token
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function user_cerate($option)
	{
		$url = 'nimserver/user/create.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 更新云信id
	 * @param  array $option 包含更新id的参数：accid,props,token
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function user_update($option)
	{
		$url = 'nimserver/user/update.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 更新云信id并获取token
	 * @param  array $option 包含更新id的参数：accid
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function user_refreshToken($option)
	{
		$url = 'nimserver/user/refreshToken.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 封禁云信id
	 * @param  array $option 包含封禁id的参数：accid
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function user_block($option)
	{
		$url = 'nimserver/user/block.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 解禁云信id
	 * @param  array $option 包含解禁id的参数：accid
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function user_unblock($option)
	{
		$url = 'nimserver/user/unblock.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 更新云信id信息
	 * @param  array $option 包含更新id信息的参数：accid,name,singn,icon,email,birth,mobile,gender,ex
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function user_updateUinfo($option)
	{
		$url = 'nimserver/user/updateUinfo.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 获取云信id信息
	 * @param  array $option 包含获取id信息的参数：accids 为array2json串儿
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function user_getUinfos($option)
	{
		$url = 'nimserver/user/getUinfos.action';
		return $this->neteaseim_post($url, $option);
	}



	/**
	 * friend 相关接口
	 */

	/**
	 * 好友添加
	 * @param  array $option accid,faccid,type[1:直接,2请求,3同意,4拒绝],msg
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function friend_add($option)
	{
		$url = 'nimserver/friend/add.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 好友备注名
	 * @param  array $option accid,faccid,alias
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function friend_update($option)
	{
		$url = 'nimserver/friend/update.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 好友删除
	 * @param  array $option accid,faccid
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function friend_delete($option)
	{
		$url = 'nimserver/friend/delete.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 好友查询
	 * @param  array $option accid,createtime
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function friend_get($option)
	{
		$url = 'nimserver/friend/get.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 好友屏蔽
	 * @param  array $option accid,targetAcc,relationType[1:黑名单,2:静音],value[0:取消,1:添加]
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function friend_setSpecialRelation($option)
	{
		$url = 'nimserver/friend/setSpecialRelation.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 好友屏蔽查询
	 * @param  array $option accid
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function friend_listBlackAndMuteList($option)
	{
		$url = 'nimserver/friend/listBlackAndMuteList.action';
		return $this->neteaseim_post($url, $option);
	}


	/**
	 * msg 相关接口
	 */

	/**
	 * 消息
	 * @param  array $option from,ope,to,type,body,option,pushcontent,payload,ext
	 * 参数	类型	必须	说明
	 * from	String	是	发送者accid，用户帐号，最大32字节，
	 * 必须保证一个APP内唯一
	 * ope	String	是	0：点对点个人消息，1：群消息，其他返回414
	 * to	String	是	ope==0是表示accid即用户id，ope==1表示tid即群id
	 * type	String	是	0 表示文本消息,
	 * 1 表示图片，
	 * 2 表示语音，
	 * 3 表示视频，
	 * 4 表示地理位置信息，
	 * 6 表示文件，
	 * 100 自定义消息类型
	 * body	String	是	请参考下方消息示例说明中对应消息的body字段，
	 * 最大长度5000字节，为一个json串
	 * option	String	否	发消息时特殊指定的行为选项,Json格式，可用于指定消息的漫游，存云端历史，发送方多端同步，推送，消息抄送等特殊行为;option中字段不填时表示默认值 option示例:
	 * {"push":false,"roam":true,"history":false,"sendersync":true,"route":false,"badge":false,"needPushNick":true}
	 * 字段说明：
	 * 1. roam: 该消息是否需要漫游，默认true（需要app开通漫游消息功能）； 
	 * 2. history: 该消息是否存云端历史，默认true；
	 * 3. sendersync: 该消息是否需要发送方多端同步，默认true；
	 * 4. push: 该消息是否需要APNS推送或安卓系统通知栏推送，默认true；
	 *  5. route: 该消息是否需要抄送第三方；默认true (需要app开通消息抄送功能);
	 *  6. badge:该消息是否需要计入到未读计数中，默认true;
	 * 7. needPushNick: 推送文案是否需要带上昵称，不设置该参数时默认true;
	 * pushcontent	String	否	ios推送内容，不超过150字节，option选项中允许推送（push=true），此字段可以指定推送内容
	 * payload	String	否	ios 推送对应的payload,必须是JSON,不能超过2k字节
	 * ext	String	否	开发者扩展字段，长度限制1024字节
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function msg_sendMsg($option)
	{
		$url = 'nimserver/msg/sendMsg.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 消息
	 * @param  array $option
	 * 参数	类型	必须	说明
	 * fromAccid	String	是	发送者accid，用户帐号，最大32字节，必须保证一个APP内唯一
	 * toAccids	String	是	["aaa","bbb"]（JSONArray对应的accid，如果解析出错，会报414错误），限500人
	 * type	String	是
	 * 0 表示文本消息,
	 * 1 表示图片，
	 * 2 表示语音，
	 * 3 表示视频，
	 * 4 表示地理位置信息，
	 * 6 表示文件，
	 * 100 自定义消息类型
	 * body	String	是	请参考下方消息示例说明中对应消息的body字段，最大长度5000字节，为一个json串
	 * option	String	否	发消息时特殊指定的行为选项,Json格式，可用于指定消息的漫游，存云端历史，发送方多端同步，推送，消息抄送等特殊行为;option中字段不填时表示默认值 option示例:
	 * {"push":false,"roam":true,"history":false,"sendersync":true,"route":false,"badge":false,"needPushNick":true}
	 * 字段说明：
	 * 1. roam: 该消息是否需要漫游，默认true（需要app开通漫游消息功能）； 
	 * 2. history: 该消息是否存云端历史，默认true；
	 * 3. sendersync: 该消息是否需要发送方多端同步，默认true；
	 * 4. push: 该消息是否需要APNS推送或安卓系统通知栏推送，默认true；
	 * 5. route: 该消息是否需要抄送第三方；默认true (需要app开通消息抄送功能);
	 *  6. badge:该消息是否需要计入到未读计数中，默认true;
	 * 7. needPushNick: 推送文案是否需要带上昵称，不设置该参数时默认true;
	 * pushcontent	String	否	ios推送内容，不超过150字节，option选项中允许推送（push=true），此字段可以指定推送内容
	 * payload	String	否	ios 推送对应的payload,必须是JSON,不能超过2k字节
	 * ext	String	否	开发者扩展字段，长度限制1024字节
	 * @return json          "Content-Type": "application/json; charset=utf-8"
	 */
	public function msg_sendBatchMsg($option)
	{
		$url = 'nimserver/msg/sendBatchMsg.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * [msg_upload description]
	 * @param  [type] $option [description]
	 * content	String	是	字节流base64串(Base64.encode(bytes)) ，最大15M的字节流
	 * type	String	否	上传文件类型
	 * @return [type]         [description]
	 */
	public function msg_upload($option)
	{
		$url = 'nimserver/msg/upload.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * [msg_fileUpload description]
	 * @param  [type] $option [description]
	 * content	String	是	字节流base64串(Base64.encode(bytes)) ，最大15M的字节流
	 * type	String	否	上传文件类型
	 * @return [type]         [description]
	 */
	public function msg_fileUpload($option)
	{
		$url = 'nimserver/msg/fileUpload.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 发送自定义系统通知
	 * @param  [type] $option [description]
	 * 参数	类型	必须	说明
	 * from	String	是	发送者accid，用户帐号，最大32字节，APP内唯一
	 * msgtype	String	是	0：点对点自定义通知，1：群消息自定义通知，其他返回414
	 * to	String	是	msgtype==0是表示accid即用户id，msgtype==1表示tid即群id
	 * attach	String	是	自定义通知内容，第三方组装的字符串，建议是JSON串，最大长度1024字节
	 * pushcontent	String	否	iOS推送内容，第三方自己组装的推送内容,不超过150字节
	 * payload	String	否	iOS推送对应的payload,必须是JSON,不能超过2k字节
	 * sound	String	否	如果有指定推送，此属性指定为客户端本地的声音文件名，长度不要超过30个字节，如果不指定，会使用默认声音
	 * save	String	否	1表示只发在线，2表示会存离线，其他会报414错误。默认会存离线
	 * option	String	否	发消息时特殊指定的行为选项,Json格式，可用于指定消息计数等特殊行为;option中字段不填时表示默认值。
	 * option示例：
	 * {"badge":false,"needPushNick":false,"route":false}
	 * 字段说明：
	 * 1. badge:该消息是否需要计入到未读计数中，默认true;
	 * 2. needPushNick: 推送文案是否需要带上昵称，不设置该参数时默认false(ps:注意与sendMsg.action接口有别);
	 * 3. route: 该消息是否需要抄送第三方；默认true (需要app开通消息抄送功能)
	 * @return [type]         [description]
	 */
	public function msg_sendAttachMsg($option)
	{
		$url = 'nimserver/msg/sendAttachMsg.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * 批量发送自定义系统通知
	 * @param  [type] $option [description]
	 * 参数	类型	必须	说明
	 * fromAccid	String	是	发送者accid，用户帐号，最大32字节，APP内唯一
	 * toAccids	String	是	["aaa","bbb"]（JSONArray对应的accid，如果解析出错，会报414错误），最大限500人
	 * attach	String	是	自定义通知内容，第三方组装的字符串，建议是JSON串，最大长度1024字节
	 * pushcontent	String	否	iOS推送内容，第三方自己组装的推送内容,不超过150字节
	 * payload	String	否	iOS推送对应的payload,必须是JSON,不能超过2k字节
	 * sound	String	否	如果有指定推送，此属性指定为客户端本地的声音文件名，长度不要超过30个字节，如果不指定，会使用默认声音
	 * save	String	否	1表示只发在线，2表示会存离线，其他会报414错误。默认会存离线
	 * option	String	否	发消息时特殊指定的行为选项,Json格式，可用于指定消息计数等特殊行为;option中字段不填时表示默认值。
	 * option示例：
	 * {"badge":false,"needPushNick":false,"route":false}
	 * 字段说明：
	 * 1. badge:该消息是否需要计入到未读计数中，默认true;
	 * 2. needPushNick: 推送文案是否需要带上昵称，不设置该参数时默认false(ps:注意与sendBatchMsg.action接口有别)。
	 * 3. route: 该消息是否需要抄送第三方；默认true (需要app开通消息抄送功能)
	 * @return [type]         [description]
	 */
	public function msg_sendBatchAttachMsg($option)
	{
		$url = 'nimserver/msg/sendBatchAttachMsg.action';
		return $this->neteaseim_post($url, $option);
	}

	/**
	 * team 相关接口(暂不提供)
	 */

	/**
	 * chatroom 相关接口(暂不提供)
	 */

	/**
	 * history 相关接口(暂不提供)
	 */



	/**
	 * [neteaseim_post description]
	 * @param  [type] $url  [description]
	 * @param  [type] $body [description]
	 * @return [type]       [description]
	 */
	public function neteaseim_post($url, $body)
	{
		$api = $this->url . $url;

		$appkey   = $this->appkey;
		$nonce    = str_random(64);
		$curtime  = time();
		$checksum = sha1($appkey.$nonce.$curtime);

		$header   = [];
		$header[] = 'AppKey: '.$appkey;
		$header[] = 'Nonce: '.$nonce;
		$header[] = 'CurTime: '.$curtime;
		$header[] = 'CheckSum: '.$checksum;
		$header[] = 'Content-Type: application/x-www-form-urlencoded;charset=utf-8';

		return $this->postCurl($api, $body, $header, "POST");
	}

	/**
	 *$this->postCurl方法
	 */
	public function postCurl($url,$body,$header,$type="POST"){
		//1.创建一个curl资源
		$ch = curl_init();
		//2.设置URL和相应的选项
		curl_setopt($ch,CURLOPT_URL,$url);//设置url
		//1)设置请求头
		//array_push($header, 'Accept:application/json');
		//array_push($header,'Content-Type:application/json');
		//array_push($header, 'http:multipart/form-data');
		//设置为false,只会获得响应的正文(true的话会连响应头一并获取到)
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt ( $ch, CURLOPT_TIMEOUT,5); // 设置超时限制防止死循环
		//设置发起连接前的等待时间，如果设置为0，则无限等待。
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
		//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//2)设备请求体
		if (count($body)>0) {
			//$b=json_encode($body,true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);//全部数据使用HTTP协议中的"POST"操作来发送。
		}
		//设置请求头
		if(count($header)>0){
			curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
		}
		//上传文件相关设置
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// 对认证证书来源的检查
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);// 从证书中检查SSL加密算

		//3)设置提交方式
		switch($type){
			case "GET":
				curl_setopt($ch,CURLOPT_HTTPGET,true);
				break;
			case "POST":
				curl_setopt($ch,CURLOPT_POST,true);
				break;
			case "PUT"://使用一个自定义的请求信息来代替"GET"或"HEAD"作为HTTP请									                     求。这对于执行"DELETE" 或者其他更隐蔽的HTT
				curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"PUT");
				break;
			case "DELETE":
				curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"DELETE");
				break;
		}


		//4)在HTTP请求中包含一个"User-Agent: "头的字符串。-----必设

		curl_setopt($ch, CURLOPT_USERAGENT, 'SSTS Browser/1.0');
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip');

		curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)' ); // 模拟用户使用的浏览器
		//5)


		//3.抓取URL并把它传递给浏览器
		$res    = curl_exec($ch);
		$result = json_decode($res,true);
		//4.关闭curl资源，并且释放系统资源
		curl_close($ch);

		if(empty($result))
			return $res;
		else
			return $result;

	}
}
