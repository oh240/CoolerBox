$(function(){
	
  $('#items tbody').sortable({
      axis: 'y',
      opacity: 0.3,
			start: function (event,ui){ui.item.css("background-color","#FFFFCC");},
			stop: function (event,ui){
				ui.item.css("background-color","#FFFFCC");
				setTimeout(function(){
					ui.item.animate(
						{
							backgroundColor: "#FFFFFF"
						},1000);
					},500);
			},
      handle: '.dragItem',
      update: function() {
          $.post('ajax/_ajax_sort.php', {
              item: $(this).sortable('serialize')
          });
      }
  });
	
	$("#items tbody").disableSelection();
	
	$(document).on('click','.addItem',function(){
		var name = $('#Add_name').val();
		var nums = $('#Add_nums').val();
		$.post('ajax/_ajax_insert.php', {
			name: name,
			nums: nums
		}, function(rs) {
			var e = $(
				'<tr id="item_'+rs+'"data-id="'+rs+'">'+
					'<td>'+
						'<input type="checkbox">'+
						'<span>'+name+'</span>'+
					'</td>'+
					'<td class="nums_area">'+nums+'</td>'+
					'<td class="date_area"> - </td>'+
					'<td>'+
						'<span class="editItem"> <i class="icon-pencil"></i></span>'+
						'<span class="deleteItem"> <i class="icon-remove"></i></span>'+
						'<span class="dragItem"> <i class="icon-move"></i></span>'+
					'</td>'+
				'</tr>'
			);
			$('#items').append(e).find('tr:last');
			$('#Add_nums').val('');
			$('#Add_name').val('').focus();
		});
	});
	
	
	$(document).on('click','.deleteItem',function(){
		
		if(confirm('本当に削除を行いますか')){
			var id = $(this).parent().parent().data('id');
			$.post('ajax/_ajax_delete.php' , {
				id: id
			}, function(rs) {
				$('#item_'+id).fadeOut(1000);
			});
		}
		
	});
	
	$(document).on('click','.checkbox',function(){
			var id = $(this).parent().parent().data('id');
			var name = $(this).next();
			var tr = $(this).parent().parent();
			$.post('ajax/_ajax_check.php' , {
				id: id
			}, function(rs) {
				if (name.hasClass('end')) {
					name.removeClass('end');
				} else {
					name.addClass('end');
				}
				changePrev(id);
			});
	});
	
	$(document).on('click','.editItem',function(){
		var id = $(this).parent().parent().data('id');
		var name = $("#item_"+id).find('span').text();
		var nums = $("#item_"+id).find('.nums_area').text();
		//var date = $("#item_"+id).find('.date_area').text();
		//$("#item_"+id).find('tr').text();
		var e = $(
				'<td>'+
					'<input type="text" id="" class="col_9 nameinput" value="'+name+'">'+
				'</td>'+
				'<td>'+
					'<input type="text" id="" class="col_5 numsinput" value="'+nums+'">'+
				'</td>'+
				'<td>'+
					'<input type="date" class="col_7 dateinput">'+
				'</td>'+
				'<td>'+
					'<button class="small updateItem">編集する</button>'+
				'</td>'
		);
		
		$("#item_"+id).empty().append(e);
		$('#item_'+id+' input:eq(0)').focus();
		
	});
	
	$(document).on('click','.updateItem',function(){
    var id = $(this).parent().parent().data('id');
		var name = $("#item_"+id).find('.nameinput').val();
		var nums = $("#item_"+id).find('.numsinput').val();
		var date = "-"
		
    $.post('ajax/_ajax_update.php', {
        id: id,
        name: name,
				nums: nums
    }, function(rs) {
        var e = $(
					'<td>'+
						'<input type="checkbox">'+
						'<span>'+name+'</span>'+
					'</td>'+
					'<td class="nums_area">'+nums+'</td>'+
					'<td class="date_area">'+date+'</td>'+
					'<td>'+
						'<span class="editItem"> <i class="icon-pencil"></i></span>'+
						'<span class="deleteItem"> <i class="icon-remove"></i></span>'+
						'<span class="dragItem"> <i class="icon-move"></i></span>'+
					'</td>'
        );
        $('#item_'+id).empty().append(e);
				changePrev(id);
    });
		
	});
	
});

function changePrev(id){
	$("#item_"+id).css({backgroundColor: "#FFFFCC"});
  setTimeout(function(){
		$("#item_"+id).animate({
			backgroundColor: "#FFFFFF"
		},1000);
  },500);
}