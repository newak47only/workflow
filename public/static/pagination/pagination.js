/**
* 分页JS代码 
* mail@ruyicms.com
* 如意内容管理系统 RUYICMS 
* 颜色修改 pagination-info,pagination-success,pagination-success,pagination-warning,pagi*nation-danger; 大小修改pagination-sm，pagination-lg
* 
*/

function pages(total, now_page, list_number, prefix_url) {
		if (isEmpty(total)) {
			total = 1;
		}
		if (isEmpty(now_page)) {
			now_page = 1;
		}
		if (isEmpty(list_number)) {
			list_number = 10;
		}
		var max = Math.ceil(total / list_number);
		now_page = Number(now_page);
		now_page = max > now_page ? now_page : max;
		var str = '<ul class="pagination pagination-sm pagination-rose">';
		//颜色修改 pagination-info,pagination-success,pagination-success,pagination-warning,pagination-danger; 大小修改pagination-sm，pagination-lg
		var start = now_page < 6 ? start = 1 : now_page - 5;
		var end = (start + 9) < max ? (start + 9) : max;
		if (now_page > 1) {
			var page_pre = now_page - 1;
			str += '<li class="page-item"><a class="page-link" href="' + prefix_url + page_pre + '">上一页</a></li>';
		}
		for (var i = start; i <= end; i++) {
			str += (i == now_page) ? '<li class="page-item active"><a class="page-link" href="#">' + i + '</a></li>' :
			'<li class="page-item"><a class="page-link" href="' + prefix_url + i + '">' + i + '</a></li>';
		}

		if (now_page < max) {
			var page_next = now_page + 1;
			str += '<li class="page-item"><a class="page-link" href="' + prefix_url + page_next + '">下一页</a></li>';
		}
		str += '</ul>';
		return str;
	}

	function isEmpty(obj)
	{
		if (typeof obj == "undefined" || obj == null || obj == "") {
			return true;
		}
		if (obj.length == 0) {
			return true;
		}
		if (typeof obj == "string") {
			obj = obj.replace(/\s+/g, '');
			if (obj == "") {
				return true;
			}
		}
		return false;
	}