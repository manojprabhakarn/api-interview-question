<?php
// show database table
${basename(__FILE__, '.php')}=function($tablename="auth"){

$con=Database::getConnection();
$result = mysqli_query($con,"SELECT * FROM $tablename");

 echo "<table border='1'>
 <tr>
 <th>username</th>
 <th>password</th>
 <th>email</th>
 </tr>";

 while($row = mysqli_fetch_array($result))
 {
 echo "<tr>";
 echo "<td>" . $row['username'] . "</td>";
 echo "<td>" . $row['password'] . "</td>";
 echo "<td>" . $row['email'] . "</td>";
 echo "</tr>";
 }
 echo "</table>";

 mysqli_close($con);
 

};
