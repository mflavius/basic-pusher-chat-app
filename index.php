<?php
/**
 * Created by PhpStorm.
 * User: mckenzie.flavius
 * Date: 28/11/2016
 * Time: 11:36
 */



?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Chat Application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>

<div class="col-lg-4 col-lg-offset-4">
    <form name="pusher-form">
        <label for="username">Username</label>
        <input name="username" type="text" id="username" class="form-control">
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="30" rows="10" class="form-control" style="resize: none;"></textarea>
        <button class="btn btn-primary btn-block" name="btn-send" id="btn-send">Send</button>
    </form>

    <br><hr><br>

    <div class="messages">

    </div>

</div>

<section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // Enter your own Pusher App key
        var pusher = new Pusher('');
        // Enter a unique channel you wish your users to be subscribed in.
        var channel = pusher.subscribe('test_channel');

        channel.bind('my_event', function(data) {
            // Add the new message to the container
            $('.messages').append('<p>' + data.message + '</p>');
            // Display the send button
            $('.input_send_holder').html('<input type = "submit" value = "Send" class = "btn btn-primary input_send" />');
            // Scroll to the bottom of the container when a new message becomes available
        });

        // AJAX request
        function ajaxCall(ajax_url, ajax_data) {
            $.ajax({
                type: "POST",
                url: ajax_url,
                dataType: "json",
                data: ajax_data,
                success: function(response, textStatus, jqXHR) {
                    console.log(response, textStatus);
                    console.log(jqXHR.responseText);
                },
                error: function(msg) {}
            });
        }

        // Send the Message
        $('body').on('click', '#btn-send', function(e) {
            e.preventDefault();

            var message = $('#message').val();
            var name = $('#username').val();

            // Validate Name field
            if (name === '') {
                alert('<br /><p>Please enter a Name.</p>');

            } else if (message !== '') {
                // Define ajax data
                var chat_message = {
                    name: $('#username').val(),
                    message: '<strong>' + name + '</strong>: ' + message
                }
                // Send the message to the server
                ajaxCall('message_relay.php', chat_message);

                // Clear the message input field
                $('#message').val('');
                // Show a loading image while sending
                $('.input_send_holder').html('<input type = "submit" value = "Send" class = "btn btn-primary" disabled /> &nbsp;<img src = "loading.gif" />');
            }
        });
    </script>
</section>
</body>
</html>
