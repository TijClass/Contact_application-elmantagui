<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,900;1,100;1,400;1,900&display=swap"
        rel="stylesheet">
    <title>Contact Application</title>
</head>

<body>
    <nav class="nav-bar">
        <div class="nav-bar-container">
            <div class="logo-container">
                <img src="public/img/brand.png" alt="Brand logo">
            </div>
            <div class="brand-name-container">
                <h1 class="brand-name">
                    Contact Application
                </h1>
            </div>
        </div>
    </nav>
    <main class="login-container">
        <div class="welcome-block">
            <h1 class="welcome-block-title text-6xl">welcome</h1>
            <p class="welcome-block-par text-3xl">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi
                quidem tenetur minus
                eveniet illo
                voluptates Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, nobis!.</p>
            <button class="welcome-block-btn" href="#"> &#60; &nbsp; Learn more</button>
        </div>
        <div class="login-form-block">
            <h1 class="login-form-title text-5xl text-center">Login</h1>
            <form action="/auth" method="POST">
                <div class="form-items">
                    <label for="">Email</label>
                    <input class="text-lg" required type="text" value="mike@email.com" name="email" placeholder="john@doe.com">
                </div>
                <div class="form-items">
                    <label class="text-lg" for="">Password</label>
                    <input type="password" required name="password" value="123321" placeholder="********">
                </div>
                <div class="form-items checkbox-item">
                    <input type="checkbox" name="rememberme" checked>
                    <label class="text-lg" for="">Remember me</label>
                </div>
                <div class="form-items-btn">
                    <button class="login-btn">Sign in</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>