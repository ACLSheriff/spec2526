<?php

function new_ticket($conn, $post)
{//creates fuction
// doing a prepared stament
    $sql = "INSERT INTO ticket (type, quantity, price) VALUES(?,?,?)";//easy to sql attack
    $stmt = $conn->prepare($sql);//prepare sql

    $stmt->bindValue(1, $post['type']);
    $stmt->bindValue(2, $post['quantity']);
    $stmt->bindValue(3, $post['price']);

    $stmt->execute();// run the query to insert
    $conn = null;// gets rid of connection to make sure no open connection which is secrity breach
    return true;
}


