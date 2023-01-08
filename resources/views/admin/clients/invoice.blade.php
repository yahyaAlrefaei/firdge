<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/> --}}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>
            Deals Requests
        </title>
    </head>
    <style>
        body {
        font-family: "DeJaVu Sans", Helvetica, sans-serif;
        /* font-family: 'dejavu sans', sans-serif; */
        /* font-family: 'Amiri', serif; */
        color: #121212;
        line-height: 15px;
    }

    table, tr, td {
        padding: 6px 6px;
        border: 1px solid black;
    }

    tr {
        height: 40px;
    }

    </style>

    <body>
        <div style="width:100%; margin:0px auto;">
            <div style="height:80px">
                <div style="width:80%; float:left; font-size:13px; color:#383838; font-weight:400;">
                    <div>
                        <strong>
                            Name of company
                        </strong>
                    </div>
                    <br>
                    <div>
                        Period : date range
                    </div>
                    <br>
                    <div>
                        Print Date : {{ now()->toDateString()}}
                    </div>
                    <div>
                        {{$package->name}}
                        {{$package->address}}
                    </div>
                </div>
                <div style="width:20%; float:left;font-size:15px; color:#383838; font-weight:400;">
                    <div>
                        <div>
                            {{-- @if (!empty($company_logo))
                                <img src="{{ url('public/images/logos/'.$company_logo) }}" width="288" height="90" alt="Logo"/>
                            @else
                                <img src="{{ url('public/uploads/userPic/default-logo.jpg') }}" width="288" height="90">
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear:both">
            </div>
            <div style="margin-top:30px;">
                <table style="width:100%; border-radius:1px;  border-collapse: collapse;">

                    <tr style="background-color:#f0f0f0;text-align:center; font-size:12px; font-weight:bold;">
                        <td>Date</td>
                        <td>User</td>
                        <td>Deal</td>
                        <td>Amount</td>
                        <td>Profits</td>
                        <td>Currency</td>
                        <td>Status</td>
                    </tr>


                    <tbody>
                        <tr>
                        <td>اهلا بيك</td>
                        <td>اهلا بيك</td>
                        <td>اهلا بيك</td>
                        <td>اهلا بيك</td>
                        <td>اهلا بيك</td>
                        <td>اهلا بيك</td>
                        <td>اهلا بيك</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
