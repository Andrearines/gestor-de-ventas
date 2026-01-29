<?php

namespace models;

class TeamMember extends Main
{
    public static $table = 'team_members';
    static $columnDB = ['id', 'team_id', 'user_id', 'joined_at'];

    public $id;
    public $team_id;
    public $user_id;
    public $joined_at;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}
