/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
	$('.batchButton').click(function(){
		if($('.selectids:checked').length <= 0){
			alert("请选择要操作的选项!");
			return false;
		}
		var data = new Array();
		$('.selectids:checked').each(function(i){
			data.push($(this).val());
		});
        if(data.length > 0){
            	var type = $(this).attr('mold');
            	var val = $(this).attr('val');
                $.post(batchUpdate_URl,{'selectids[]':data,'type':type,'val':val}, function (data) {
                      if (data=='ok') {
                            window.location.href=window.location.href;
                            return true;
                      }else{
				alert('更新失败！');
                      }
                });
        }
	});
});

