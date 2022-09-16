<?php

function clear() {
    if (PHP_OS === "WINNT") 
        system("cls");
    else
        system("clear");

}


// Possible words
$random_words = ["Book", "Table", "Guitar", "Software", "Hardware", "System", "Tecnology"];
define("MAX_ATTEMPS", 6);

do {
    
   
    
      // Starting game
    $choosen_word = $random_words[ rand(0, 6) ];
    $choosen_word = strtolower($choosen_word);
    $word_length = strlen($choosen_word);
    $discovered_letters = str_pad(" ", $word_length, "_ ");
    $attempts = 0;


    
    do {
    
        print_game();
    
        $player_letter = readline("Write a letter: ");
        $player_letter = strtolower($player_letter);
        
        if ( str_contains($choosen_word, $player_letter) ) {
    
            $discovered_letters = check_letters($choosen_word, $player_letter, $discovered_letters);
        }
        else {
    
            print_wrong_letter();       
        }
        
        clear();
    
    } while( $GLOBALS["attempts"] < MAX_ATTEMPS && $discovered_letters != $choosen_word );
    
    end_game();

    echo "\n";

    $reset_game = readline("Do you want to play again? Y/N \n");

} while($reset_game == "Y");


function check_letters($word, $letter, $discovered_letters) {

    $offset = 0;
    while ( ( $letter_position = strpos($word, $letter, $offset) ) !== false ) {
        $discovered_letters[$letter_position] = $letter;
        $offset = $letter_position + 1;
    }

    return $discovered_letters;
}

function print_wrong_letter() { 

    clear();
    $GLOBALS["attempts"]++;
    echo "Wrong letter. You got " . (MAX_ATTEMPS - $GLOBALS["attempts"]) . " attempts.";
    sleep(2);
}

function print_man() {
    global $attempts;

    switch($attempts) {

        case 0:
            echo "
            +---+
            |   |
                |
                |
                |
                |
            =========
            ";
            break;

        case 1:
            echo "
            +---+
            |   |
            O   |
                |
                |
                |
            =========
            ";
            break;

        case 2:
            echo "
            +---+
            |   |
            O   |
            |   |
                |
                |
            =========
            ";
            break;

        case 3:
            echo "
            +---+
            |   |
            O   |
           /|   |
                |
                |
            =========
            ";
            break;

        case 4:
            echo "
            +---+
            |   |
            O   |
           /|\  |
                |
                |
            =========
            ";
            break;

        case 5:
            echo "
            +---+
            |   |
            O   |
           /|\  |
           /    |
                |
            =========
            ";
            break;

        case 6:
            echo "
            You killed me Bro...
            +---+
            |   |
            O   |
           /|\  |
           / \  |
                |
            =========
            ";
            break;

    }

    echo "\n\n";

    
}

function print_game() {

    global $word_length, $discovered_letters;

    echo "***Hangman Game*** \n\n";

    print_man();

    echo "Word with $word_length letters: \n\n";
    echo $discovered_letters;
    echo "\n\n";

}

function end_game() {

    global $attempts, $choosen_word, $discovered_letters;

    clear();

    if ($attempts < MAX_ATTEMPS) {

        echo "Congratulation!!! You guessed the word. :D \n\n";
    }
    else {
        
        echo "Good look for next time budy. X__X \n\n";
        print_man();
    }

    echo "The word is: $choosen_word\n";
    echo "Discovered letters: $discovered_letters\n";

}

echo "\n";