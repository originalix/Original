/**
 * Created by Lix on 2017/5/18.
 */
;(function () {
  'use strict';

  var $form_add_task = $('.add-task')
    , new_task = {}
    ;

  $form_add_task.on('submit', function (e) {
    /*禁用默认行为*/
    e.preventDefault();
    /*获取新Task的值*/
    new_task.content = $(this).find('input[name=content]').val();
    /*如果新Task的值为空，则直接返回 否则继续执行*/
    console.log('new_task', new_task);
  })
})();
