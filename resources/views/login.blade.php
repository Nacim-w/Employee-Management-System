<h1> User login </h1>
<form action="" method="POST">
    @csrf 
    <input type="text" name="user" placeholder="Name"> <br>
    <input type="password" name="password" placeholder="password">
    <br><button type="submit">Login</button>