<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>
    <form action="result.php" method="POST">
        <table>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
            </tr>
            <tr>
                <td>Tires</td>
                <td><input type="number" id="tires" name="tires" /></td>
            </tr>
            <tr>
                <td>Oil</td>
                <td><input type="number" id="oil" name="oil" /></td>
            </tr>
            <tr>
                <td>Sqarkphgs</td>
                <td><input type="number" id="sqarkphgs" name="sqarkphgs" /></td>
            </tr>
            <tr>
                <td>How did you find Bob's?</td>
                <td>
                    <select name="find">
                        <option value="01">Im a regular customer</option>
                        <option value="02">TV advertising</option>
                        <option value="03">Phone directory</option>
                        <option value="04">Word of mouth</option>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" value="submit">
    </form>
</body>

</html>