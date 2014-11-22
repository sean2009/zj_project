/**
 * 
 */
//var area_next_url = '/area/next.html';
//var area_list_url = '/area/list.html';
var area_next_url = '/index.php?r=area/next';
var area_list_url = '/index.php?r=area/list';
function selectArea(obj,type){
        if(type == undefined){
            type = '';
        }else if(type == 0){
             type = '';
        }
	if(obj == undefined){
		var parent_id = 0;
	}else{
		var parent_id = $(obj).val();
		$(obj).nextAll('.selectArea').remove();
		$('#area_id' + type).val(0);
		if(parent_id == ''){
			return false;
		}
	}
	var depth_id = $('#depth_id' + type).val();
	var depth_num = $('#depth_num' + type).val();
	$.getJSON(base_url + area_next_url,{parent_id:parent_id,depth_id:depth_id,depth_num:depth_num,type:type},function(data){
		if(data.status == '1'){
			$('#area_id' + type).val(0);
			$('#selectArea' + type).append(data.items);
		}else{
			$('#area_id' + type).val(data.items);
		}
		$('#depth_id' + type).val(data.depth);
	});
}
function selectAreaList(id,type){
        if(type == undefined){
            type = '';
        }
	$.getJSON(base_url + area_list_url,{id:id,type:type},function(data){
		if(data.status == '1'){
			$('#selectArea' + type).append(data.items);
		}else{
			alert(data.msg);
		}
	});
}
