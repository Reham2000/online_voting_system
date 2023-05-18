<?php

namespace App\Database\Models;

use App\Database\Models\Model;

class Users_votes extends Model
{
    private $userId,$voteId,$vote;

    public function voteForOnce()
    {
        $query = "SELECT * FROM `users_votes` WHERE `user_id` = ? AND `vote_id` = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii',$this->userId,$this->voteId);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function create()
    {
        $query = "INSERT INTO `users_votes` (user_id,vote_id,vote) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iii',$this->userId,$this->voteId,$this->vote);
        return $stmt->execute();

    }
    



    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of voteId
     */ 
    public function getVoteId()
    {
        return $this->voteId;
    }

    /**
     * Set the value of voteId
     *
     * @return  self
     */ 
    public function setVoteId($voteId)
    {
        $this->voteId = $voteId;

        return $this;
    }

    /**
     * Get the value of vote
     */ 
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set the value of vote
     *
     * @return  self
     */ 
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }
}