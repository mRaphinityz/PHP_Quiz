<!-- Example from pages 362 -364 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Quiz</title>
</head>
<body>
    <?php
        // associative array of the questions and answers
        $StateCaptials = array(
            "Connecticut" => "Hartford",
            "Maine" => "Augusta",
            "Massachusetts" => "Boston",
            "Rhode Island" => "Concord",
            "Vermont" => "Montpelier",);

        // determine if the submit button was clicked
        if(isset($_POST["submit"])) {
            // create an array out of the array of the user-submitted data
            $Answers = $_POST["answers"];
            // accumulator variable for the scoring
            $Score = 0;
            // variable storing how many questions there are
            $Questions = count($Answers);

            if (is_array($Answers)) {
                // we checked $Answers and it IS an array
                foreach($Answers as $State => $Response) {
                    $Response = stripslashes($Response);
                    // check this response to see if it was left empty
                    if(strlen($Response) > 0) {
                        // we have an attempt at an answer
                        if (strcasecmp($StateCaptials[$State], $Response) == 0) {
                            echo "<p>Correct! The capital of $State is " . $StateCaptials[$State] . ".</p>\n";
                            ++$Score;
                        }
                        else {
                            // this answer was left empty
                            echo "<p>Sorry, the Capital of $State is not $Response.</p>\n";
                        }
                    }
                    else {
                        echo "<p>You did not enter a value for the capital of $State!</p>\n";
                    }   
                }// end of foreach loop 
            }
            echo "<p style='color= red;'>You got a score of $Score out of $Questions!</p>\n";
            echo "<p><a href='Quiz.php'>Try Again?</a></p>\n";
            
        }
        else {
            echo "<form action='Quiz.php' method='Post'>\n";
            foreach($StateCaptials as $State => $Response) {
                echo "The capital of $State is: <input type='text' name='answers[" . $State . "]' /><br/>\n";
            } // end of foreach loop
            echo "<input type='submit' name='submit' value='Check Answers' />";
            echo "<input type='reset' name='reset' value='Reset Form' />\n";
            echo "</form>\n";
        }
    ?>
</body>
</html>