$(document).ready(function(){    $('#dataTables-users').DataTable({        responsive: true    });    //email lose focus    $email = $('#email');    $email_error = $('#email_error');    $email.bind('focusout',function() {        if($.trim($email.val()) != '') {            if(!isValidMail($email.val())) {                validate_input_error($email_error, '电子邮件不合法！');                return false;            } else {                validate_input_success($email_error);            }        }    });    //add info submit	$('#btn_save').click(function(){        //user pass lose focus        $pass = $('#password');        $pass_error = $('#userpass_error');        var patter_val = /^[-_0-9a-zA-Z]+$/;        if ($.trim($pass.val()) === '') {            validate_input_error($pass_error, '请输入密码！');            return false;        } else {            if ($pass.val().length < 2 || !patter_val.test($pass.val())) {                validate_input_error($pass_error, '密码不合法，只允许字母、数字、以及中划线-、下划线_');                return false;            } else {                validate_input_success($pass_error);            }        }        //password confirm lose focus        $pass_confirm = $('#confirm_password');        $pass_confirm_error = $('#confirmpass_error');        if ($.trim($pass.val()) === '') {            return false;        }        if ($.trim($pass_confirm.val()) === '') {            validate_input_error($pass_confirm_error, '请输入密码！');            return false;        } else {            if ($pass_confirm.val().length < 2) {                validate_input_error($pass_confirm_error, '密码不合法，只允许字母、数字、以及中划线-、下划线_');                return false;            } else if (($pass.val() != $pass_confirm.val())) {                validate_input_error($pass_confirm_error, '确认密码与密码不一致！');                return false;            } else {                validate_input_success($pass_confirm_error);            }        }        $role = $('#role_id');        $role_error = $('#userrole_error');        if ($.trim($role.val()) === '') {            validate_input_error($role_error, '请选择用户角色！');            return false;        } else {            validate_input_success($role_error);        }        $name.triggerHandler('focusout');				if($('.onError').length > 0) {			//the first error text get focus			if($('span.onError').siblings('input').get(0) != undefined) {				$('span.onError').siblings('input').get(0).focus();			} else {				$('span.onError').siblings('select').get(0).focus();			}			return false;		}	});});