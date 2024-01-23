<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: block;
            max-width: 150px;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-top: 0;
        }

        p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .btn-reset {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 18px;
            padding: 12px 30px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-reset:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
           
            <img class="logo" src="https://i.ibb.co/BcrLvzS/Logo.png" alt="Logo">
        </div>

        <h1 class="text-center">Contact Mail</h1>
        
        <table class="table">
       
          <tbody>
            <!--<tr>-->
            
            <!--  <td>Name</td>-->
            <!--  <td>Email</td>-->
            <!--  <td>Phone</td>-->
            <!--  <td>Whatsapp</td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--  <th>{!! $body['name'] !!}</th>-->
            <!--  <th>{!! $body['email'] !!}</th>-->
            <!--   <th>{!! $body['phone'] !!}</th>-->
            <!--    <th>{!! $body['whatsapp'] !!}</th>-->
            <!--</tr>-->
            <tr>
                <th>Name</th>
                 <th>{!! $body['name'] !!}</th>
            </tr>
              <tr>
                <th>Email</th>
                 <th>{!! $body['email'] !!}</th>
            </tr>
              <tr>
                <th>Phone</th>
                 <th>{!! $body['phone'] !!}</th>
            </tr>
              <tr>
                <th>Whatsapp</th>
                 <th>{!! $body['whatsapp'] !!}</th>
            </tr>
       
       
          </tbody>
          <p>{!! $body['message'] !!}</p>
        </table>
      
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>