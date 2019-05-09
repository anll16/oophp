<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     * @var int $prevGuess    The most recent guess.

     */

    private $number;
    private $tries;
    private $prevGuess;
    private $status;



    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        if ($number === -1) {
            $this->number = $this->random();
        }
        $this->tries = $tries;
    }




    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return int
     */

    public function random()
    {
        return rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }

    /**
     * Get previousGuess.
     *
     * @return int as prevGuess.
     */

    public function prevGuess()
    {
        return $this->prevGuess;
    }

    /**
     * Get status.
     *
     * @return string as status.
     */

    public function status()
    {
        return $this->status;
    }




    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }




    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     */

    public function makeGuess(int $number)
    {
        if ($number > 100 || $number < 1) {
            throw new GuessException("Must be between 1 and 100");
        }

        $this->tries -= 1;
        $this->prevGuess = $number;


        if ($number > $this->number) {
            $this->status = 'TOO HIGH';
        } elseif ($number < $this->number) {
            $this->status = 'TOO LOW';
        } elseif ($number === $this->number) {
            $this->status = 'CORRECT';
        }

        if ($this->tries === 0 && $this->status !== 'CORRECT') {
            $this->status = 'GAME OVER';
        }
    }
}
