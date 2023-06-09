<?php
require "./model/DataBase.php";
$db = new DataBase();
if ($db->dbConnect()) {

$students=$db->getAllStudents();

foreach ($students as $student) {
	?><tr>
                <td><?php echo $student['id']; ?></td>
                <td><?php echo $student['firstname']; ?></td>
                <td><?php echo $student['lastname']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><?php echo $student['birthday']; ?></td>
                <td><?php echo $student['place']; ?></td>
                <td><?php echo $student['univname']; ?></td>
                <td><?php echo $student['department']; ?></td>
                <td><?php echo $student['specialty']; ?></td>
                <td><?php echo $student['card_id']; ?></td>
            </tr><?php
}
}
?>