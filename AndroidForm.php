<?php



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        .container{

        }
        .left{
            height:auto;
            width: 33%;
            display: inline-block;
            text-align: center;
        }
        .mid{
            height:auto;
            width: 33%;
            display: inline-block;
            text-align: center;
        }
        .right{
            height:auto;
            width: 33%;
            display: inline-block;
            text-align: center;
        }

    </style>
</head>

<body>
<div class="container">
    <div class="left">
        <h2>Insert</h2>
        <form action="database.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>ID</td>
                    <td><input type="number" name="id" > </td>
                </tr>
                <tr>
                    <td>Enrollment</td>
                    <td><input type="number" name="enrollment"> </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" > </td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name"> </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" > </td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td><input type="number" maxlength="10" name="mobile" > </td>
                </tr>
                <tr>
                    <td>Stream </td>
                    <td><input type="text" name="stream" > </td>
                </tr>
                <tr>
                    <td><input type="submit"  ></td>
                </tr>
            </table>
        </form>
</body>
</div>
<div class="mid">
<h2>Search</h2>
    <form action="search.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Enter E Number</td>
                <td><input type="text" name="search"></td>
                <td><input type="submit"></td>
            </tr>

        </table>
    </form>
</div>
<div class="right">
<h2>delete</h2>
    <form action="delete.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Enter E Number for delete</td>
                <td><input type="text" name="delete"></td>
                <td><input type="submit"></td>
            </tr>

        </table>
    </form>
</div>


</div>
</html>
