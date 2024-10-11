<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Sử dụng Bootstrap từ CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- Sử dụng tệp CSS từ thư mục public -->
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

   <div class='container-fluid m-0 p-0'>
    <div class="chatbot-header">
        <span class="bot-name">ChatBot</span>
    </div>

    <div id="content-box" class="p-2">
        {{--output:--}}
    </div>

    <div class="chatinput">
        <input type='text' id="input" placeholder="Type a message...">
        <button id="button-submit" class="btn">Send</button>
    </div>
   </div>

   <script src="https://code.jquery.com/jquery-3.6.3.js" crossorigin="anonymous"></script>
   <script>
        // Cấu hình Ajax để thêm CSRF token vào các yêu cầu
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#button-submit').on('click', function() {
            var value = $('#input').val(); // Lấy giá trị của input
            $('#content-box').append(`<div class="user-message float-right">` + value + `</div> <div style="clear: both"></div>`);
            $('#input').val(''); // Xóa nội dung input sau khi gửi

            // Gửi yêu cầu Ajax
            $.ajax({
                type: "POST",
                url: '/send',
                data: { message: value }, // Dữ liệu gửi đi
                success: function(data) {
                    $('#content-box').append(`
                        <div class="bot-message">
                            <img src="#" alt="Bot">
                            <div>` + data + `</div>
                        </div>
                    `);
                    // Cuộn nội dung xuống cuối
                    $('#content-box').scrollTop($('#content-box')[0].scrollHeight);
                }
            });
        });
   </script>
</body>

</html>
