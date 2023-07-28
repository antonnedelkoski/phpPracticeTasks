<?php
//In a toy store there are 2 types of toys: balls and squares. Squares and balls are described by parameters like color(string) and density(int). Additionally, iti s known that balls have a radius(int), while squuares/boxese have width,height and depth.
//Make methods getWeight() and  getVolume(). Mass is calculated by multiplying volume and density of the toy
//1.Count how many toys from the array have the same color as your toy and are the same type
//Print YES if the whole mass of all toys is  bigger than the one of your toy, NO in opposite.
//Absolute value of volume of the toy with max volume and  your toy.
    abstract class Toys {
        abstract public function getWeight();
        abstract public function getVolume();

        public function printIt()
        {
            print $this->getWeight()." Weight, and the Volume is: ".$this->getVolume()."\n";
        }

    }

    class Squares extends Toys {

        public string $color;
        protected int $depth;
        protected int $height;
        protected int $width;

        function __construct($color,$depth,$height,$width)
        {
            $this->color = $color;
            $this->depth = $depth;
            $this->height = $height;
            $this->width = $width;
        }
        public function getWeight(): float|int
        {
          $weight = $this->getVolume() * $this->depth;
          return $weight;
        }

        public function getVolume(): float|int
        {
            return $this->depth * $this->height * $this->width;
        }
    }

    class Balls extends Toys
    {
        public string $color;
        protected int $depth;
        protected int $radius;

        function __construct($color,$depth,$radius)
        {
            $this->color = $color;
            $this->depth = $depth;
            $this->radius = $radius;
        }

        public function getWeight(): float|int
        {
            // TODO: Implement getWeight() method.
            return $this->getVolume() * $this->depth;
        }

        public function getVolume(): float|int
        {
            // TODO: Implement getVolume() method.
            return 4 / 3 * 3.14 * ($this->radius^3);
        }
    }
        $toysArray = array();
        $Square1 = new Squares('blue',1,1,1);
        $toysArray[] = $Square1;
        $Square2 = new Squares('blue',1,1,1);
        $toysArray[] = $Square2;
        $Square3 = new Squares('blue',1,1,1);
        $toysArray[] = $Square3;
        $Square4 = new Squares('claret',1,1,1);
        $toysArray[] = $Square4;
        $Ball1 = new Balls("red",1,1);
        $toysArray[] = $Ball1;
        $Ball2 = new Balls("red",1,1);
        $toysArray[] = $Ball2;
        $Ball3 = new Balls("red",1,1);
        $toysArray[] = $Ball3;

        $count = 1;
        $myToy = new Balls('blue',1,15);
        $maxVolume = 0;
        $sumWeight = 0;
        foreach ($toysArray as $toy)
        {
            if($toy->getVolume() > $maxVolume) {
                $maxVolume = $toy->getVolume();
            }

            if($myToy->color == $toy->color){
                $count++;
            }

            $sumWeight += $toy->getWeight();
            $abs = abs($myToy->getVolume() - $maxVolume);
        }

        echo "So ista boja imas $count igracki \n";

        if($sumWeight > $myToy->getWeight()) {
            echo "Da\n";
        }
        else {
            echo "Ne\n";
        }

        echo"Apsolutnata vrednost na volumenot iznesuva: $abs \n";
