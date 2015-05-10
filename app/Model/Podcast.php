<?php
class Podcast extends AppModel{
    public $hasMany = array('PodcastConnectedTags', 'PodcastConnectedAuthors');
    public $hasOne = array('Stat');
    public $belongsTo = array('PodcastFile');
}