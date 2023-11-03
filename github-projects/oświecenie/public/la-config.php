<?php
$GLOBALS["perfix"] = "articles_";

function pdoConn(){
    $dbServername = "localhost";
    $dbUsername = "";
    $dbPassword = "";
    $dbName = "";

    try {
        $pdo = new PDO("mysql:host=$dbServername;dbname=$dbName", $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return null;
}

function execSqlFile($fileName){
    $pdo = pdoConn();
    $sqlCommands = file_get_contents($fileName);
    $stmt = $pdo->prepare($sqlCommands);
    $stmt->execute();
}

function selcetTable($tableName){
    $pdo = pdoConn();

    if ($pdo !== null) {
        $result = $pdo->query( "SELECT * FROM " . $GLOBALS["perfix"]. $tableName);
    
        $arr = array();
        if ($result->rowCount() > 0) {
            foreach($result as $row) {
                array_push($arr, $row);
            }
        } else {
            echo "0 results";
        }
    
        $pdo = null;
        return $arr; 
    }
}

function getPostsByTags($tagIds) {
    $pdo = pdoConn();

    $str = "";
    foreach($tagIds as $tag){
        $str .= "'" . $tag . "',";
    }
    $str = substr($str, 0, strlen($str)-1); 

    $sql = "SELECT p.* FROM  ". $GLOBALS["perfix"] . "posts p
            JOIN " . $GLOBALS["perfix"] . "posts_tags pt ON p.id = pt.post_id
            WHERE pt.tag_id IN (". $str .")
            GROUP BY p.id";
    
    $stmt = $pdo->prepare($sql);
  
    $stmt->execute();
  
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    return $results;
}



function insertTag($tag){
    $pdo = pdoConn();

    if ($pdo !== null) {
        try {
            $result = $pdo->query("INSERT INTO " . $GLOBALS["perfix"] ."tags (name) VALUES ('$tag')");
            if ($result === false) {
                echo "Error while executing SQL: " . $pdo->errorInfo()[2];
            } else {
                echo "Data inserted successfully";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        $pdo = null;
    }
}

function deleteTagById($id) {
    $pdo = pdoConn();

    if ($pdo !== null) {
        try {
            $result = $pdo->query("DELETE FROM " . $GLOBALS["perfix"] . "tags WHERE id = '$id'");
            if ($result === false) {
                echo "Error while executing SQL: " . $pdo->errorInfo()[2];
            } else {
                echo "Tag with id = $id was deleted successfully";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        $pdo = null;
    }
}

function updateTagById($id, $newName) {
    $pdo = pdoConn();

    if ($pdo !== null) {
        try {
            $result = $pdo->query("UPDATE ". $GLOBALS["perfix"] . "tags SET name = '$newName' WHERE id = '$id'");
            if ($result === false) {
                echo "Error while executing SQL: " . $pdo->errorInfo()[2];
            } else {
                echo "Tag with id = $id was updated successfully";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        $pdo = null;
    }
}

function selectTagById($id){
    $pdo = pdoConn();

    if ($pdo !== null) {
        $sql = "SELECT * FROM " . $GLOBALS["perfix"] . "tags WHERE id = ?";
        try {
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        $pdo = null;
    }
}

function selectIdByTag($tag) {
    $pdo = pdoConn();
    $id = false;

    if ($pdo !== null) {
        $sql = "SELECT id FROM " . $GLOBALS["perfix"] . "tags WHERE name = ?";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$tag]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result !== false) {
                $id = $result['id'];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $pdo = null;
    }

    return $id;
}


function insertPost($title, $subtitle, $description){
    $pdo = pdoConn();
    $postId = null;
    if($pdo !== null){
        try {
            $stmt = $pdo->prepare('INSERT INTO ' . $GLOBALS["perfix"]. 'posts(title, subtitle, description) VALUES(:title, :subtitle, :description)');

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':subtitle', $subtitle);
            $stmt->bindParam(':description', $description);

            $stmt->execute();
            $postId = $pdo->lastInsertId();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    $pdo = null;
    return $postId;
}

function editPost($postId, $title, $subtitle, $description) {
    $pdo = pdoConn();

    if ($pdo !== null) {
        $sql = "UPDATE " . $GLOBALS["perfix"] . "posts SET title = ?, subtitle = ?, description = ? WHERE id = ?";
        try {
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$title, $subtitle, $description, $postId]);
            echo "Data updated successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        $pdo = null;
    }
}

function addPostTags($postId, $tagIds){
    $pdo = pdoConn();
    if ($pdo !== null) {
        $data = [];
        foreach ($tagIds as $id) {
            $data[] = [$postId, $id];
        }

        $sql = "INSERT INTO " . $GLOBALS["perfix"] . "posts_tags (post_id, tag_id) VALUES (?, ?)";
        try {
            $stmt= $pdo->prepare($sql);
            foreach ($data as $row) {
                $stmt->execute($row);
            }
            echo "Data inserted successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        $pdo = null;
    }
}

function deleteAllPostTags($postId){
    $pdo = pdoConn();

    if ($pdo !== null) {
        $sql = "DELETE FROM " . $GLOBALS["perfix"] . "posts_tags WHERE post_id = ?";
        try {
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$postId]); 
            echo "Data deleted successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        $pdo = null;
    }
}

function getPostTags($postId){
    $pdo = pdoConn();

    if ($pdo !== null) {
        $sql = "SELECT ". $GLOBALS["perfix"]."tags.name FROM " . $GLOBALS["perfix"] ."tags
                JOIN " . $GLOBALS["perfix"] . "posts_tags ON ". $GLOBALS["perfix"]. "tags.id = " . $GLOBALS["perfix"]."posts_tags.tag_id
                WHERE ". $GLOBALS["perfix"]."posts_tags.post_id = ?";
            
        try {
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$postId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        $pdo = null;
    }
}