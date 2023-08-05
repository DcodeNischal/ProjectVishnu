<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=VT323"/>
    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            background-color: #1E2A3A;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'VT323', monospace;
            flex-direction: column;
        }

        body .login-buttons{
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #34D399;
            width: 50%;
            height: 50%;
            flex-direction: column;
            border-radius: 10px;
        }

        body .login-buttons a{
            text-decoration: none;
            color: #1E2A3A;
            font-size: 1.5rem;
            font-weight: 100;
            padding: 1rem 2rem;
            border-radius: 10px;
            background-color: #F9FAFB;
            transition: all 0.3s ease;
        }

        body .login-buttons a:hover{
            background-color: #1E2A3A;
            color: #F9FAFB;
        }

        .home{

            margin-top: 2rem;


        }

        .home a{
            text-decoration: underline;
            color: #F9FAFB;
            font-size: 1rem;
            font-weight: 100;
            padding: 1rem 2rem;
            border-radius: 10px;
            background-color: #1E2A3A;
            transition: all 0.3s ease;
        }

    </style>
</head>
<body>

    <div class="login-buttons">
        <a href="app/html/admin/login-root.php">Admin</a>
        <a href="app/html/company/login-company.php">Company</a>
        <a href="app/html/researcher/login-researcher.php">Researcher</a>
    </div>

    <div class="home">
        <a href="index.php">Home</a>
    </div>
    
</body>
</html>