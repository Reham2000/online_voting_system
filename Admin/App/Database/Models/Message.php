<?php

namespace App\Database\Models;

use App\Database\Models\Crud;
use App\Database\Models\Model;

class Message extends Model implements Crud
{
  private $id,$title,$message,$time,$reply,$reply_at,$user_id,$admin_id;

  public function create()
  {
    $query = "INSERT INTO `messages` (title,message,user_id) VALUES (?,?,?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('ssi',$this->title,$this->message,$this->user_id);
    return $stmt->execute();
  }
  public function read()
  {
    $query = "SELECT * FROM `messages`";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
  }
  public function update()
  {

  }
  public function delete()
  {
    $query = "DELETE FROM `messages` WHERE `id` = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i',$this->id);
    return $stmt->execute();
  }
  public function getMyMessages()
  {
    $query = "SELECT * FROM `messages` WHERE `admin_id` = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i',$this->admin_id);
    $stmt->execute();
    return $stmt->get_result();
  }
  public function getMessagesByUserId()
  {
    $query = "SELECT * FROM `messages` WHERE `user_id` = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i',$this->user_id);
    $stmt->execute();
    return $stmt->get_result();
  }
  public function reply()
  {
    $query = "UPDATE `messages` SET `reply` = ?, `reply_at` = ?,`admin_id` = ? WHERE `id` = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('ssii',$this->reply,$this->reply_at,$this->admin_id,$this->id);
    $stmt->execute();
    return $stmt->get_result();
  }
  public function repliedNum()
  {
    $query = "SELECT count(*) FROM `messages` WHERE `reply` is NOT null";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
  }
  public function notRepliedNum()
  {
    $query = "SELECT count(*) FROM `messages` WHERE `reply` is null";
    $stmt = $this->conn->prepare($query);
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
     * Get the value of message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */
    public function setTime($time)
    {
        $this->time = $time;

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
   * Get the value of reply
   */
  public function getReply()
  {
    return $this->reply;
  }

  /**
   * Set the value of reply
   *
   * @return  self
   */
  public function setReply($reply)
  {
    $this->reply = $reply;

    return $this;
  }

  /**
   * Get the value of reply_at
   */
  public function getReply_at()
  {
    return $this->reply_at;
  }

  /**
   * Set the value of reply_at
   *
   * @return  self
   */
  public function setReply_at($reply_at)
  {
    $this->reply_at = $reply_at;

    return $this;
  }

  /**
   * Get the value of admin_id
   */
  public function getAdmin_id()
  {
    return $this->admin_id;
  }

  /**
   * Set the value of admin_id
   *
   * @return  self
   */
  public function setAdmin_id($admin_id)
  {
    $this->admin_id = $admin_id;

    return $this;
  }
}
