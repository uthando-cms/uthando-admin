
var admin = {
	dataTable : {
		rowClick : function(e){
			var trId = $(this).find('td:first-child').text();
	        var title = $(this).find('td.tab-title').text();
	        title = (title) ? title : 'User';
	        
	        
	        if ($('#user'+trId).length) {
	            $('#userTabs a[href=#user'+trId+']').tab('show');
	        } else {
	            $('#userTabs')
	            .append('<li><a href="#user'+trId+'">'+title+'&nbsp;<em class="close">&times;</em></a></li>');
	            $('#userTabContent')
	            .append('<div class="tab-pane" id="user'+trId+'">Loading...</div>');
	            
	            $('#user'+trId).load('user/edit', {userId : trId},
	                function (responseText, textStatus, req) {
	                    
	                    if (textStatus == "error") {
	                        $('#user'+trId).html(responseText);
	                    }
	            });
	        
	            $('#userTabs a[href=#user'+trId+']').tab('show');
	        }
		}
	},
	
	tabs : {},
	
	setupTabs : function(id)
    {
		$('#'+id).on('click', 'a', function(e) {
        	e.preventDefault();
        	$(this).tab('show');
    	});
    
    	$(id+' a:first').tab('show');
    	this.tabs[id] = $('#'+id+' a:first');
    
    	$(id).on('click', '.close', function(e){ 
    		$($(this).parent().attr('href')).remove();
    		$(this).parent().parent().remove();
    		this.tabs[id]('show');
    	});
	},

    addAlert : function(message, type)
    {
        $('#alerts').append(
            '<div class="alert alert-' + type + ' fade in">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + message + '</div>'
        );
        $(".alert").alert();
        setTimeout('$(".alert").alert("close")',5000);
    },

    ajaxModalForm : function(el, url)
    {
        response = $.ajax({
            url: url,
            data:  $(el).find('form').serialize(),
            type: 'POST',
            success: function (response) {
                if ($.isPlainObject(response)) {
                    admin.addAlert(response.messages, response.status);
                    $(el).modal('hide');
                    return response;
                } else {
                    $(el).find('.modal-body').html(response);
                }
            },
            error: function (response) {
                admin.addAlert(response.error, 'danger');
                $(el).modal('hide');
            }
        });

        return response;
    },

    ajaxWidgetPanel : function(el, url, data)
    {
        $(el).load(url, data, function(responseText, textStatus) {
            if (textStatus == "error") {
                $(el).css('padding', '10px');
                $(el).html(responseText);
            }
        });
    },

    tinyMceFileBrowser : function(callback, value, meta, url, baseUrl) {
        var dialog = bootbox.dialog({
            title: "File Uploader",
            show: false,
            message: '<i class="fa fa-spinner fa-spin"></i>&nbsp;Loading',
            buttons: {
                main: {
                    label: "Close",
                    className: "btn-default"
                }
            }
        });
        dialog.css('z-index', '1000000');
        dialog.on('show.bs.modal', function () {
            $(this).find('.modal-body').load(url);
        });
        dialog.on('hide.bs.modal', function (e) {
            $(this).find('.modal-body').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Loading');

            if (admin.upload && admin.upload.status) {
                var imagePath = baseUrl;
                // Provide file and text for the link dialog
                /*if (meta.filetype == 'file') {
                 callback(admin.upload.image.name);
                 }*/

                // Provide image and alt text for the image dialog
                if (meta.filetype == 'image') {
                    callback(imagePath + admin.upload.image.name);
                }

                // Provide alternative source and posted for the media dialog
                /*if (meta.filetype == 'media') {
                 callback(admin.upload.image.name);
                 }*/
            }
        });
        dialog.modal('show');
    }
};

$(document).ready(function(){

    $("#admin-sidebar").metisMenu({
        doubleTapToGo: true
    });

    $('button[type=submit]').click(function(){
        $(this).button('loading');
        $('input').focus(function(){
        	$(this).button('reset');
        }.bind(this));
    });
    
    $('#showPassword').click(function(){
		var change = $(this).is(":checked") ? "text" : "password";
		document.getElementById('password').type = change;
	});
});
