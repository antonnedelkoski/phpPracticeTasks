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
$task4 = new MyCalculator(8, 8.4);


echo $task2->add() . "\n"; 
echo $task3->multiply() . "\n"; 
echo $task2->subtract() . "\n"; 
echo $task1->divide() . "\n"; 
echo $task4->divide() . "\n"


