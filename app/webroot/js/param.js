$(document).ready(function(){    $('#dataTables-category').DataTable({        responsive: true    });	//from or to lose focus	$from = $('#from');	$from_error = $('#from_error');    $from.bind('focusout',function(){		if(($.trim($from.val())) === '') {			validate_input_error($from_error, '请输入区间开始值！');			return false;		} else {			check_name_exist();		}	});    //name lose focus    $type = $('#value');    $type_error = $('#value_error');    $type.bind('focusout',function(){        if(($.trim($type.val())) === '') {            validate_input_error($type_error, '请输入系数值！');            return false;        } else {            validate_input_success($customer_error);        }    });		//add info submit	$('#btn_save').click(function(){        $name.triggerHandler('focusout');				if($('.onError').length > 0) {			//the first error text get focus			if($('span.onError').siblings('input').get(0) != undefined) {				$('span.onError').siblings('input').get(0).focus();			} else {				$('span.onError').siblings('select').get(0).focus();			}			return false;		}	});		$('#btn_reset').click(function(){        if($('#id').val() == '') {            window.location.href = "/params/add";        } else {            window.location.href = "/params/edit?id="+$('#id').val();        }	});});//check name exist or notfunction check_name_exist() {	var parameters = '/params/checkExist?name=' + encodeURIComponent($.trim($name.val())) + '&id=' + $('#id').val();	check_exist($name_error,parameters,'该系数名称已存在！');}