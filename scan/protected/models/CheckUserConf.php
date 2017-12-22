<?php
/**
 * app表审核相关状态
 */

  class CheckUserConf
  {
      //App表状态
      const NEW_QR_CODE = 2; //新二维码
      const USEABLE = 1;     //可用
      const UNUSEABLE = 0;  //不可用
      const DISABLE = 3;//强制下线

      const NEW_SCAN_TIMES = 10; //新创建的二维码允许扫码次数
  }