jQuery(document).ready(function($){
    var endpoint = wpApiSettings.root;
    var nonce = wpApiSettings.nonce;
    
    $("#wp-admin-bar-delete-all-cache a").on('click',function(event){
        
        event.preventDefault();
        
        $.ajax({
            url: endpoint+'wp-super-cache/v1/cache',
            method: 'POST',
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-WP-Nonce',nonce);
                popup("Please wait cache is been deleted!!",true);
            },
            success: function(data){
                if(Object.values(data)[0]){
                    popup(Object.keys(data)[0],false);
                }else{
                    popup("Problem in deleting Cache",false);
                }
            },
            error: function(){
                popup("Problem in deleting Cache",false);
            }
        });
        
    });
    
});

function popup(msg,show_hide){
    var $ = jQuery;
    if($("#bws-popup-container").length == 0){
        $('body').append('<div id="bws-popup-container"><div id="bws-msg">'+msg+'</div></div>');
    }else{
        $('#bws-msg').html(msg);
    }
    if(!show_hide){
        setTimeout(function(){ $("#bws-popup-container").remove(); }, 700);
    }
}