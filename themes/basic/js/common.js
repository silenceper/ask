function add_comment(action,title,username,comment_id){
	//设置action 地址
	$('#comment-form').attr('action',action);
	//设置标题
	$('#comment_title').text(title);
	//设置内容
	$('#comment_message').val(username+' ');
	//设置comment_id
	$('#comment_id').val(comment_id);
	$('#commentModal').modal();
}
