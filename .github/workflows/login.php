<!DOCTYPE html>

<html>
<head>
    <!-- Connect to the RAMS CSS3 -->
    <link href="styles/styles.css" rel="stylesheet" type="text/css" />
    <title>Welcome to RAMS</title>
</head>

<body>
    <!-- Username and password input form -->
    <div class="login">        
    <h1 style="color: white;">RAMS</h1>
    <p class=\"ErrorText\">Type your username and password to login<br><br></p>
    <!-- Pressing the login button the RAMS API function do_login (api.php?action=do_login) is executed -->
    <form action="api.php?action=do_login" method="POST" enctype="multipart/form-data">
    <table class="style1" style="margin-left: auto; margin-right:  auto;">
        <tr>
            <!-- Username input box -->
            <td><p class="Content" style="margin:  2px;">
                <label for="username">Username:</label>
            </td>
            <td><p class="Content"  style="margin:  2px;">
                <input id="username" title="Your username" name="username" required type="text" style="border: 0px; background-color: #1e5d8a; color:  white;"/></p>
            </td>
        </tr>
        <tr>
            <!-- Password input box -->
            <td><p class="Content"  style="margin:  2px;">
                <label for="password">Password:</label>
            </td>
            <td><p class="Content"  style="margin:  2px;">
                <input id="Text1" title="Your password"  name="password" required type="password" style="border: 0px; background-color: #1e5d8a; color:  white;"/></p>
            </td>
        </tr>
        <tr>
            <!-- Login button -->
            <td><br><br></td>
            <td><br><p class="Content" style="margin:  2px;"><input type="submit" value="Login" style="border: 0px; text-align: center; width: 100px; background-color: #4d9ddb; color: #fff"/></p></td>
        </tr>
    </table>
    </form>
    </div>
</body>
</html>
