<?php

/**
 * @file
 * Contains class for Trello Boards
 */

/**
 * Class containing essential functions for interacting with Trello Boards via
 * the Trello API
 */
class TrelloBoard extends Trello {

  public $id;

  public function __construct($id) {
    $this->id = $id;
  }

}
