<?php

namespace App\Database\Models;

use App\Database\Models\Model;
use App\Database\Models\Crud;

class Admin extends Model implements Crud
{
  private $id,$username,$password,$role,$created_at,$updated_at;
  public function create()
  {
    $query = "INSERT INTO `admins` (username,password,role) VALUES (?,?,?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('ssi',$this->username,$this->password,$this->role);
    return $stmt->execute();
  }
  public function read()
  {
    $query = "SELECT * FROM `admins`";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
  }
  public function update()
  {
    $query = "UPDATE `admins` SET `username` = ? ,`role` = ?  WHERE `id` = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('sii',$this->username,$this->role,$this->id);
    $stmt->execute();
    return $stmt->get_result();
  }
  public function delete()
  {
    $query = "DELETE FROM `admins` WHERE `id` = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i',$this->id);
    return $stmt->execute();
  }
  public function ChangePassword()
  {
    $query = "UPDATE `admins` SET `username` = ? ,`password` = ? ,`role` = ?  WHERE `id` = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('ssii',$this->username,$this->password,$this->role,$this->id);
    $stmt->execute();
    return $stmt->get_result();
  }
  public function getAdminByUsername()
    {
        $query = "SELECT * FROM `admins` WHERE `username` = ? ";
        $stmt =$this->conn->prepare($query);
        $stmt->bind_param('s',$this->username);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function getAdminById()
    {
        $query = "SELECT * FROM `admins` WHERE `id` = ? ";
        $stmt =$this->conn->prepare($query);
        $stmt->bind_param('i',$this->id);
        $stmt->execute();
        return $stmt->get_result();
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
   * Get the value of role
   */
  public function getRole()
  {
    return $this->role;
  }

  /**
   * Set the value of role
   *
   * @return  self
   */
  public function setRole($role)
  {
    $this->role = $role;

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
}
