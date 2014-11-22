<?php

/*
 * 同步订单数据
 */
class TaskCommand extends CConsoleCommand {
    
    /*
      * 根据修改时间增量查询最新添加的订单和修改过状态的订单
     * ./yiic task order
     */
    public function run(){
       MessageService::model()->sendMessage();
    }
}    
?>
