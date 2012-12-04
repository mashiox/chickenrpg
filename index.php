<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'include/gamemechanics.functions.php';
$title = fun_titlemessages();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <?php
        
      /*$p1_rate_mph = round(fprand(.1, 300, 10), 2);
        $p2_rate_mph = round(fprand(.1, 300, 10), 2);
        $p1_turn_point = fprand(0, $distance_miles, 1);
        $p1_turn_time = $p1_turn_point/$p1_rate_mph;
        $p2_turn_point = fprand(0, $distance_miles, 1);
        $p2_turn_time = $p2_turn_point/$p2_rate_mph;
        $collision_time = $distance_miles/($p1_rate_mph+$p2_rate_mph);
        echo 'Dist: '.$distance_miles.'<br>P1 Rate: '.$p1_rate_mph.'<br>P2 Rate:'.$p2_rate_mph.'<br>Collis: '.$collision_time;
        if ($p1_turn_time < $collision_time && $p2_turn_time < $collision_time){
            echo '<br>Both players turned early.<br>They obviously don\' understand the point of chicken.';
        }
        else if ($p2_turn_time < $collision_time){
            echo '<br>P2 turned early.<br>P2 is a pussy.';
        }
        else if ($p1_turn_time < $collision_time){
            echo '<br>P1 turned early.<br>P1 is a pussy.';
        }
        else if ($p1_turn_time > $collision_time && $p2_turn_time > $collision_time){
            echo '<br>Everybodies dead.';
        }*/
        
        if ( isset($_POST['distance']) ){
            //isset($_POST['p1rate'], $_POST['p1chicken'], $_POST['distance']) && is_numeric($_POST['p1rate']) && is_numeric($_POST['p1chicken'])
            if (!isset($_POST['p1rate']) || !is_numeric($_POST['p1rate']) )
                $_POST['p1rate'] = round (fprand (.1, 300, 2));
            if (!isset($_POST['p1chicken']) || !is_numeric($_POST['p1chicken']))
                $_POST['p1chicken'] = fprand (0, $_POST['distance'], 2);
            
            $player_chicken_time = $_POST['p1chicken']/$_POST['p1rate'];
            
            $enemy_rate = round(fprand(.1, 300, 2));
            $enemy_chicken_point = fprand(0, $_POST['distance'], 2);
            $enemy_chicken_time = $enemy_chicken_point/$enemy_rate;
            $collision_time = $_POST['distance']/($_POST['p1rate']+$enemy_rate);
            if ($player_chicken_time < $collision_time && $enemy_chicken_time < $collision_time){
                echo 'Both you and your opponet turned early.<br>You both don\'t really understand the point of chicken, do you?<br>Draw.<br>';
            }
            else if ($enemy_chicken_time < $collision_time){
                echo 'The enemy turned away early! The enemy is the chicken! <b>You win!</b>';
            }
            else if ($player_chicken_time < $collision_time){
                echo 'You turned away early! You are the chicken! <b>'.$_POST['enemy'].' wins!</b>';
            }
            else if ($player_chicken_time > $collision_time && $enemy_chicken_time > $collision_time){
                echo 'The carnage is unberable to watch as two screaming bafoons in cars crash into each other in a game of chicken.<br>
                    No one within '.  rand().' miles walks away without a least a minor cough from the incident, both drivers dead.<br><b>You and '.$_POST['enemy'].' loses.</b>';
            }
            else if ($player_chicken_time == 0 && $enemy_chicken_time == 0){
                echo 'Being that there was no distance between you and '.$_POST['enemy'].', '.$_POST['enemy'].' takes you by the hand and the two of you 
                    continue your journey together on foot. While wiser for the merit of not playing the game, you and your so-called opponent simultaneously win and lose, but the real victory is in the friendship that blossomed after the incredible win-loss.';
            }
            echo '
                <br><br>
                Distance Traveled by both players: '.$_POST['distance'].'
                <br><br>
                <u>You</u><br>
                Rate: '.$_POST['p1rate'].'<br>
                "Chicken Point": '.$_POST['p1chicken'].'<br>
                Time "Chickened": '.$player_chicken_time.'<br>
                <br>
                <u>'.$_POST['enemy'].'</u><br>
                Rate: '.$enemy_rate.'<br>
                "Chicken Point": '.$enemy_chicken_point.'<br>
                Time "Chickened": '.$enemy_chicken_time.'<br>
                <br><br>
                Collision Time: '.$collision_time.'<br>
                ';
            
            
            
            
            echo '<br><a href="." >Play Again</a>';
        }
        else {
            $distance_miles = round(fprand(0, 5, 5), 1);
            $enemy = enemyname();
            echo 'You are traveling down a dusty, lonesome, one-laned road. Off in the distance, you can a see a car being driven by '.$enemy.' moving toward you, '.$distance_miles.' miles away.';
            echo '<br><b>You\'re now engaged in a game of chicken.</b>
                <form method="post" action="index.php" >
                <br>
                How fast are you going?<br> <input type="number" name="p1rate" min=".1" max="300" /> [.1,300]mph<br>
                <br>When, if at all, do you want to `chicken` out?<br> <input type="number" name="p1chicken" min="0" max="'.$distance_miles.'" /> [0,'.$distance_miles.']miles
                <input type="hidden" name="distance" value="'.$distance_miles.'" />
                <input type="hidden" name="enemy" value="'.$enemy.'" />
                <br><br>You may leave these fields blank (or non-numeric) for random values.
                <br><input type="submit" value="Submit" />
                </form>
            ';
        }
        ?>
    </body>
</html>
