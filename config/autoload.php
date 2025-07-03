<?php

/* MODELS */
require "models/Game.php";
require "models/Media.php";
require "models/Player.php";
require "models/PlayerPerformance.php";
require "models/Team.php";

/* MANAGERS */
require "managers/AbstractManager.php";
require "managers/GamesManager.php";
require "managers/MediaManager.php";
require "managers/PerformanceManager.php";
require "managers/PlayersManager.php";
require "managers/TeamsManager.php";

/* CONTROLLERS */
require "controller/AbstractController.php";
require "controller/HomeController.php";
require "controller/MatchesController.php";
require "controller/PlayersController.php";
require "controller/TeamsController.php";

/* SERVICES */
require "config/database.php";
require "config/Router.php";

?>