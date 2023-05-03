<?php

namespace App\Database\Models;

use App\Database\Models\Crud;
use App\Database\Models\Model;


class Vote extends Model implements Crud
{
    private $id,$title,$description,$image,$like,$dislike,$user_id,$created_at,$updated_at;     

    public function create()
    {
        $query = "INSERT INTO `ask-vote` (title,description,image,user_id,created_at,updated_at) VALUES(?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssiss",$this->title,$this->description,$this->image,$this->user_id,$this->created_at,$this->updated_at);
        return $stmt->execute();
    }
    public function read()
    {
        $query = "SELECT * FROM `ask-vote`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function update()
    {
        $query = "UPDATE `ask-vote` SET `title` = ?,`description` = ?,`image` = ? WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssi',$this->title,$this->description,$this->image,$this->id);
        return $stmt->execute();
    }
    public function delete()
    {

    }
    public function getVoteById()
    {
        $query = "SELECT * FROM `ask-vote` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$this->id);
        $stmt->execute();
        return $stmt->get_result();
        
    }
    public function getAllVotesByUserId()
    {
        $query = "SELECT * FROM `ask-vote` WHERE `user_id` = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$this->user_id);
        $stmt->execute();
        return $stmt->get_result();
        
    }
    public function likes()
    {
        $this->like = ++$this->like;
        $query = "UPDATE `ask-vote` SET `like` = ? WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii',$this->like,$this->id);
        return $stmt->execute();
    }
    public function dislikes()
    {
        $this->dislike = ++$this->dislike;
        $query = "UPDATE `ask-vote` SET `dislike` = ? WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii',$this->dislike,$this->id);
        return $stmt->execute();
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of like
     */ 
    public function getLike()
    {
        return $this->like;
    }

    /**
     * Set the value of like
     *
     * @return  self
     */ 
    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }

    /**
     * Get the value of dislike
     */ 
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * Set the value of dislike
     *
     * @return  self
     */ 
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    public function updateImage()
    {
        $query = "UPDATE `ask-vote` SET image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('si',$this->image,$this->id);
        return $stmt->execute();
    }
}