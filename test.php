<?php 

include 'connection.php';

while( $row = mysqli_fetch_assoc( $result ) ){
                        echo "<tr><td>{$row['cname']}</td><td>{$row['m_name']}</td><td>{$row['bookid']}</td><td>{$row['bdate']}</td></tr>\n";
                    }

?>