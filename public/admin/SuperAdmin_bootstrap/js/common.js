function tipModal(txt, fn,cancel){
 	if(fn==undefined){
		var fn = function () {
			
		}
	}

	if(cancel==undefined){
        var cancel =true;
	}

	if(cancel){
        var cancelhtml = '<button type="button" data-type="cancel" class="btn btn-cancel" data-dismiss="modal">取消</button>';
    }else {
		cancelhtml ='';
	}
	var tipHtml =
		'<div class="modal fade modal-tip" id="modalTip">'+
	        '<div class="modal-dialog">'+
	            '<div class="modal-content">'+
	                '<div class="modal-header">'+
	                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
	                    '<h5 class="modal-title" id="myModalLabel">系统提示</h5>'+
	                '</div>'+
	                '<div class="modal-body">'+
	                    '<p class="tip-content">'+ txt +'</p>'+
	                '</div>'+
	                '<div class="modal-footer">'+
	                    '<button type="button" data-type="submit" class="btn btn-default">确定</button>'+cancelhtml + '</div>'+
	            '</div>'+
	        '</div>'+
	    '</div>';
	$('body').append(tipHtml);
	$('#modalTip').modal();

	$('#modalTip').on('hidden.bs.modal', function() {
		$('#modalTip').remove();
	});

	$('#modalTip button[data-type="submit"]').click(function() {
		$('#modalTip').modal('hide');
		fn();
	});
}


function alertNotice(txt, link){
	var linkhtml = '';
	if(link!=undefined){
		var linkhtml = '<a href="'+ link +'" class="alert-link">点击查看</a>';
	} 
	var html = '<div class="alert alertNotice alert-info alert-dismissible" role="alert">'+
			        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
			        '<div class="content">'+txt+' '+linkhtml+
			        '</div>'+
			    '</div>';
	$('body').append(html);
	$('.alertNotice').addClass('show');
}


function imgPreview(img){
	var imgHtml = 
		'<div class="modal fade modal-img" id="modalImg">'+
	        '<div class="modal-dialog">'+
	            '<div class="modal-content" data-dismiss="modal">'+
	                '<img src="'+ img +'" alt="">'+
	            '</div>'+
	        '</div>'+
	    '</div>';
	$('body').append(imgHtml);
	$('#modalImg').modal();

	$('#modalImg').on('hidden.bs.modal', function() {
		$('#modalImg').remove();
	});
}

function loadings(e, bg) {
	if($(e).find('.loading').length > 0) {
		return false;
	}
	var loadHtml = '<div class="loading" style="background-color:'+ bg +'"><div class="line-spin-fade-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';
	
	$(e).append(loadHtml);
	$('.loading').fadeIn();
	return true;
}

function loadingEnd(e) {
	$(e).find('.loading').fadeOut(function(){
		$(this).remove();
	});
}

function upload(ememnt,success,error){
	$(ememnt).fileinput({
		showUpload: false,
		language:'zh',
		uploadAsync:true,
		dropZoneEnabled:false,
		uploadUrl:'/common/upload',
		maxFileCount: 1,
		maxImageWidth: 600,
		resizeImage: false,
		showCaption: false,
		showPreview: false,
		showRemove:false,
		browseClass: "",
		previewFileIcon: "",
		enctype:'multipart/form-data',
	}).on("filebatchselected", function(event, files) {
 			$(this).fileinput("upload");
			$('.kv-upload-progress').css({'opacity': 1});
		})
		.on("fileuploaded", function(event, data) {
			if(data.response.status==0){
				tipModal(data.response.msg, function () {})
				return false;
			}
			success(data.response)
			$('.kv-upload-progress').css({'opacity': 0});
		});

}

function playSound()
{
    var borswer = window.navigator.userAgent.toLowerCase();
    if ( borswer.indexOf( "ie" ) >= 0 )
    {
        //IE内核浏览器
        var strEmbed = '<embed name="embedPlay" src="/seller/ding.wav" autostart="true" hidden="true" loop="false"></embed>';
        if ( $( "body" ).find( "embed" ).length <= 0 )
            $( "body" ).append( strEmbed );
        var embed = document.embedPlay;

        //浏览器不支持 audion，则使用 embed 播放
        embed.volume = 100;
        //embed.play();这个不需要
    } else
    {
        //非IE内核浏览器
        var strAudio = "<audio id='audioPlay' src='/seller/ding.wav' hidden='true'>";
        if ( $( "body" ).find( "audio" ).length <= 0 )
            $( "body" ).append( strAudio );
        var audio = document.getElementById( "audioPlay" );

        //浏览器支持 audion
        audio.play();
    }
}



/* ============== Loading ============== */
var loadHtml = '<div class="loading-wrap"><div class="loader-inner line-spin-fade-loader"> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> </div></div>';

function starLoading(e){
	if(e) {
    	$(e).append(loadHtml);
	} else {
		$('#wrapper').append(loadHtml)
	}
    $('.loading-wrap').animate({'opacity': 1});
}

function endLoading(){
    $('.loading-wrap').animate({'opacity': 0}, function(){
        $('.loading-wrap').remove();
    });
}

//封装ajax
function sendPost(url,data,success,error) {
    starLoading();
	$.ajax({
		'url':url,
		'data':data,
		'dataType':'json',
		'type':'post',
		'success':function (item,value) {
			endLoading();
			if(item.ret == 401){
                tipModal(item.msg,function () {
					error(item,value)
                })
				return false;
			}
            tipModal(item.msg,function () {
                success(item,value)
            })


        },
		'error':function(){
			endLoading();
		}

	})
}
function sendGet(url,func) {
    $.ajax({
        'url':url,
        'dataType':'json',
        'type':'get',
        'success':function (item,value) {
        	console.log(item)
            func(item,value);
        },
        'error':function(){


        }

    })
}



