<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="app/build/styles.css" rel="stylesheet">
    <link href="app/css/styles.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-green-200">
<table>
    <tr class="text-center bg-blue-500">
        <th>Name</th>
        <th>Surname</th>
        <th>Age</th>
        <th>Personal Code</th>
        <th>Address</th>
        <th>Notes</th>
    </tr>
    <?php
    foreach ($persons as $person): ?>
        <tr class="text-center bg-green-500">
    <td><?=$person->getName() ?></td>
    <td><?=$person->getSurname() ?></td>
    <td><?=$person->getAge() ?></td>
    <td><?=$person->getPersonalCode() ?></td>
    <td><?=$person->getAddress() ?></td>
    <td><?=$person->getNotes() ?></td>
</tr>
    <?php endforeach; ?>
</table>
<form method="post" action="../../index.php">
    <label for="search">Who you search?</label><br>
    <input type="text" id="search" name="search"><br><br>
    <input class="bg-yellow-500 hover:bg-yellow-700 rounded" type="submit" name="submit1" value="Search">
    <input class="bg-indigo-500 hover:bg-indigo-700 rounded" type="submit" name="clear1" value="Clear">
</form>
</body>
</html>