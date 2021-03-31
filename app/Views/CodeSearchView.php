<html lang="en">
<body>
<table class="table">
    <tr class="text-center bg-green-500">
        <th>Name</th>
        <th>Surname</th>
        <th>Age</th>
        <th>Personal Code</th>
        <th>Address</th>
        <th>Notes</th>
    </tr>
    <?php
    foreach ($result as $person): ?>
        <tr class="text-center bg-green-500">
            <td><?=$person['name'] ?></td>
            <td><?=$person['surname'] ?></td>
            <td><?=$person['age'] ?></td>
            <td><?=$person['personal_code'] ?></td>
            <td><?=$person['address'] ?></td>
            <td><?=$person['notes'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>