<?php
class PodcastConnectedAuthor extends AppModel{
    public $hasOne = array('Podcast', 'Author');
}