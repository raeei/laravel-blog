<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link rel="icon" type="image/png" href="{{url('../')}}/public/img/logomucg.png"/>
        <title>Email</title>
        
        
        <script src="js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../js/tiny-slider-2.9.4-.js">
        <script src="../js/tiny-slider-2.9.4-.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
       
        <link rel="stylesheet" href="css/summernote-bs4.min.css">
        <script src="js/summernote-bs4.min.js"></script>


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">  
            <style>
                body{
                    margin: 0;
                    background: #ffffff;
                }
                table{
                    border-spacing: 0;
                }
                td{
                    padding: 0;
                }
                .wrapper{
                    width: 100%;
                    table-layout: fixed;
                    background-color: #ffffff;
                    padding-top: 20px;
                }
                .main{
                    background-color: white;
                    margin: 0 auto;
                    width: 100%;
                    max-width: 600px;
                    border-spacing: 0;
                    font-family: sans-serif;
                }
                .content1{
                    padding: 40px;
                    background-color: #cccccc;
                    width: 100%;
                }
                @media only screen and (max-width:600px){
                    .content1{
                    padding: 10px;
                    background-color: #cccccc;
                    width: 100%;
                }
                }
            </style>
    </head>
    
    <body>
        <center class="wrapper" >
            <table class="main" width="100%">
                 <tr>
                    <td height="20" class="text-center" style="text-align: center">
                        <a href=""><img src="https://ubongibok.netlify.app/images/IMG-2894.jpg" height="80px" width="80px"/></a>
                        <!--https://laravel.com/img/notification-logo.png-->
                    </td>
                </tr>
                <tr >
                    <td class="content1" style="">
                        <table class="column" style="background-color: white; width: 100%; border-spacing: 0; table-layout: fixed; border-radius: 3px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015);">
                            <tr >
                                <td style=" padding: 40px 20px 10px 20px;">
                                    <p style="font-size: 17px; color: #718096;">Hello <strong>{{$name}}</strong>,</p>
                                </td>
                            </tr>
                             <tr >
                                <td style=" padding: 0px 20px 10px 20px;">
                                    <p style="font-size: 16px; color: #718096;">We received a request to reset your myBlog password</p>
                                </td>
                            </tr>
                            <tr >
                                <td style=" padding: 0px 20px 10px 20px;">
                                    <p style="color: #718096;"><strong>Please reset your myBlog password by clicking the button below:</strong></p>
                                </td>
                               
                            </tr>
                            <tr>
                                 <td style=" padding: 0px 20px 10px 20px; text-align: center">
                                    <a href="{{$url}}" class="btn btn-success">Reset Password</a>
                                </td>
                            </tr>
                            <tr>
                                 <td style=" padding: 20px 20px 10px 20px;">
                                     <p style="font-size: 16px; color: #718096;">This password reset link will expire in 60 minutes.</p>
                                </td>
                            </tr>
                             <tr>
                                 <td style=" padding: 0px 20px 10px 20px;">
                                     <p style="font-size: 16px; color: #718096;">If you did not request this change, no further action is required.</p>
                                </td>
                            </tr>
                            <tr>
                                 <td style=" padding: 0px 20px 0px 20px;">
                                     <p style="color: #718096;">Best Regards,</p>
                                     <p style="margin-top: -20px; color: #718096;">myBlog</p>
                                </td>
                            </tr>
                            <tr>
                                 <td style=" padding: 0px 20px 10px 20px;">
                                     <hr/>
                                </td>
                            </tr>
                            <tr>
                                 <td style=" padding: 0px 20px 10px 20px; overflow: hidden; box-sizing: border-box;">
                                     <p style="box-sizing: border-box; color: #718096; font-size: 14px;">
If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <span class="break-all" style="box-sizing: border-box; word-break: break-all;"> <a target="_blank" style="box-sizing: border-box; position: relative" href="{{$url}}">
      {{$url}}</a></span>
                                     </p>
                                 </td>
                            </tr>
                        </table>
                        
                        <table class="column" style="background-color: black; color: white; width: 100%; border-spacing: 0; table-layout: fixed; margin-top: 20px; border-radius: 3px;">
                            <tr >
                                <td style=" padding: 20px 20px 0px 20px; text-align: center; ">
                                    <h6 style="margin-bottom: 0px;"><strong>Need more help?</strong></h6>
                                </td>
                            </tr>
                             <tr >
                                <td style=" padding: 0px 20px 20px 20px; text-align: center; ">
                                    <a href="#" style="color: white; text-decoration: underline;">We're here to help you out</a>
                                </td>
                            </tr>
                        </table>
                    </td>                
                </tr>
                <tr>
                    <td style="padding: 30px 40px 0px 40px; text-align: center;">
                        <p style="font-size: 15px; color: #718096;">You are receiving this email because you have an account with myBlog</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 40px 0px 40px; text-align: center;">
                        <p style="font-size: 15px; color: #718096;">Please do not reply directly to this auto-generated email message.
                            If you have any questions or concern about your account with us, please <a href="#">contact myBlog</a></p>
                    </td>
                </tr>
                 <tr>
                    <td style="padding: 0px 40px 0px 40px; text-align: center;">
                        <p style="font-size: 15px; color: #718096;">12th Floor, Big House - 201 Broad Street, Marina, Lagos, Nigeria</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 40px 0px 40px; text-align: center;">
                        <hr/>
                    </td>
                </tr>
                 <tr>
                    <td style="padding: 0px 40px 0px 40px; text-align: center;">
                        <a href="#"><img src="../images/logo1.png" width="30px" height="30px"/></a>
                         <a href="#"><img src="../images/logo1.png" width="30px" height="30px"/></a>
                          <a href="#"><img src="../images/logo1.png" width="30px" height="30px"/></a>
                           <a href="#"><img src="../images/logo1.png" width="30px" height="30px"/></a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 40px 0px 40px; text-align: center;">
                        <p style="font-size: 15px;">© 2023 <a href="#">myBlog</a>. All rights reserved.</p>
                    </td>
                </tr>
            </table>
        </center>
        
    </body>
</html>
        
        