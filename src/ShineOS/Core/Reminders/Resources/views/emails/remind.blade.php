<html>
    <head>
        <title> Shine OS+ </title>
    </head>
    <body> 
        <table class="" cellspacing="0" border="0" cellpadding="0" align="center" width="600" style="border:5px; border-style:solid; border-color:#3973A3;">
            <tbody>
                <tr>
                    <td valign="top" background="images/article-bg-transparent.png">
                        <table cellspacing="0" border="0" cellpadding="0" align="center" width="100%">
                            <tbody>
                                <tr>
                                    <td valign="top" bgcolor="#3973A3" style="background-color: #3973A3;">
                                        <h2 style="margin: 0; font-size: 24px; color: #FFF; font-weight: strong;">
                                            Shine OS+
                                        </h2>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center" style="padding-top:2%;">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                        <h4> <strong> To: </strong> {{ $toUser_name }} </h4>
                                        <h4> <strong> From: </strong> {{ $fromFacility }} | {{ $fromUser_name }}  </h4>
                                        @if(isset($appointment_datetime))
                                        <h4> <strong> Appointment Date: </strong> {{ $appointment_datetime }} </h4>
                                        @endif
                                        <hr>                                        
                                        <h4> <strong> Message: </strong> {{ $msg }} </h4> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </body>
</html>