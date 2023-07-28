<?php
//create a simple calculator that would do simple operations.
class MyCalculator
{
    private $argument1, $argument2;

    public function __construct($argument1, $argument2)
    {
        $this->argument1 = $argument1;
        $this->argument2 = $argument2;
    }

    public function add() : float|int
    {
        return $this->argument1 + $this->argument2;
    }

    public function subtract() : float|int
    {
        if($this->argument1 > $this->argument2) {
            return $this->argument1 - $this->argument2;
        }
        else
            return $this->argument2 - $this->argument1;
    }

    public function multiply(): float|int
    {
        return $this->argument1 * $this->argument2;
    }

    public function divide() : float|int
    {
        if($this->argument1 > $this->argument2) {
            return $this->argument1 / $this->argument2;
        }
        else
            return $this->argument2 / $this->argument1;
    }
}

$task1 = new MyCalculator(12, 6);
$task2 = new MyCalculator(2.4,4.2);
$task3 = new MyCalculator(6, 2.1);


echo $task2->add() . "\n"; // Displays 18
echo $task3->multiply() . "\n"; // Displays 72
echo $task2->subtract() . "\n"; // Displays 6
echo $task1->divide() . "\n"; // Displays 2


