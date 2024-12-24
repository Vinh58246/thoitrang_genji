<?php
function mail_confim($code){
    return '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <div style="margin: 50px; background-color: rgb(246, 244, 244);">
                <div style="padding: 20px;">
                    <div>
                        <h1 style="font-family: "Keania One", serif; font-weight: 200; font-size: 43px;">GENJI</h1>
                    </div>
                    <div>
                        <p>Đây là mã xác thực của bạn, vui lòng không chia sẻ ra bên ngoài!</p>
                        <h3>'.$code.'</h3>
                    </div>
                    <div>
                        <p><strong>GENJI</strong> - Admin</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
    ';
}


