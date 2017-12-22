<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BaseController extends Controller
{
    const UNIT_NUM = 60;
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	protected function getRequest($key, $default = null){

		return ((isset($_REQUEST[$key])) ? trim(strip_tags($_REQUEST[$key])) : $default);
	}

	protected function env($key)
	{
		return Yii::app()->params[$key];
	}

	/**
	 * 发生扫码的SwooleData
	 */
	protected function sendSwooleData($swooleData)
	{
		// 发送swoole数据
		$server = $this->env('SWOOLE_SERVER_ADDRESS');
		$port = $this->env('SWOOLE_SERVER_PORT');

		$swoooleClient = new \swoole_client(SWOOLE_SOCK_UDP);
		$swoooleClient->connect($server, $port, 2);
		$swoooleClient->send(json_encode($swooleData));
	}

	/**
	 * 发生扫码的SwooleData
	 */
	protected function sendSwooleTestData($swooleData)
	{
		// 发送swoole数据
		$server = $this->env('SWOOLE_SERVER_ADDRESS_TEST');
		$port = $this->env('SWOOLE_SERVER_PORT_TEST');

		$swoooleClient = new \swoole_client(SWOOLE_SOCK_UDP);
		$swoooleClient->connect($server, $port, 2);
		$swoooleClient->send(json_encode($swooleData));
	}
}