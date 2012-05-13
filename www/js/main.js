$(function(){
    $('#message_input').focus();
    setInterval(function(){
        $.get('index.php?action=get-messages', function(data) {
            $('#message_viewer').html(data);
            $('#message_viewer').scrollTop($('#message_viewer')[0].scrollHeight);
        });
    }, 1000);
    
    $("#send_button").click(function() {
        $.post('index.php?action=post-message',{message:$('#message_input').val()}, function(){
            $('#message_input').attr('value', '');
        });
        $('#message_input').focus();
    });
    
    $("#message_input").keypress(function(event) {
        if ( event.which == 13 ) {
            $.post('index.php?action=post-message',{message:$('#message_input').val()}, function(){
                $('#message_input').attr('value', '');
            });
            return false;
        }
        $('#message_input').focus();
    });   

});
