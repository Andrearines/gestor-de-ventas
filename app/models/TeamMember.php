<?php

namespace models;

class TeamMember extends Main
{
    public static $table = 'team_members';
    static $columnDB = ['id', 'team_id', 'user_id'];

    public $id;
    public $team_id;
    public $user_id;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}
