<?php

namespace App\Database\Models;

use App\Database\Models\Crud;
use App\Database\Models\Model;


class User extends Model implements Crud
{
    private $id,$username,$phone,$password,$photo,$status,$created_at,$updated_at;

    public function create()
    {
        $this->status = 0;
        $query = "INSERT INTO users (username,phone,password,photo,status,created_at,updated_at) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssiss",$this->username,$this->phone,$this->password,$this->photo,$this->status,$this->created_at,$this->updated_at);
        return $stmt->execute();
    }
    public function read()
    {

    }
    public function update()
    {

    }
    public function delete()
    {

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
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = password_hash($password,PASSWORD_BCRYPT);

        return $this;
    }

    /**
     * Get the value of photo
     */ 
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */ 
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

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
     * Get the value of updeted_at
     */ 
    public function getUpdeted_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updeted_at
     *
     * @return  self
     */ 
    public function setUpdeted_at($updeted_at)
    {
        $this->updated_at = $updeted_at;

        return $this;
    }
}