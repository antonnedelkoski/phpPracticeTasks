<?php
//Write an application that works with geometric shapes. There are 3 shapes: Triangle, Rectangle and JustOneOrdinaryShape. They all are part of the family of shapes and therefore share some common characteristics:
//they have a function that calculates the area of the shape (triangle and rectangle have specific formulas, while all ordinary shapes calculate the area as width * height + 4
//they have a function that calculates the perimeter of the shape (triangle and rectangle have specific formulas, while all ordinary shapes calculate the perimeter as width + height + 19)
//if the width is 0, all ordinary shapes throw an exception when one of the functions above are called
//Write a function that will print json formatted objects from all classes.
abstract class Shape
{
    protected $width;
    protected $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    abstract public function printJsonObject();

    abstract public function shapeArea();

    abstract public function shapePerimeter();
}

class Triangle extends Shape {

    protected $sideA;
    protected $sideB;
    protected $sideC;

    public function __construct($width, $height,$sideA, $sideB,$sideC)
    {
        parent::__construct($width, $height);
        $this->sideA = $sideA;
        $this->sideB = $sideB;
        $this->sideC = $sideC;
    }

    public function shapeArea(): float|int
    {
        $error = "IMPOSSIBLE";
        // TODO:A=1/2 * b * h
        if($this->width > 0) {
            return 1 / 2 * $this->sideB * $this->height;
        }else{
            return trigger_error($error, E_USER_WARNING);
        }
    }

    public function shapePerimeter()
    {
        $error = "IMPOSSIBLE";
        // TODO:P=a+b+c
        if($this->width > 0) {
            return $this->sideA + $this->sideB + $this->sideC;
        }
        else{
            return trigger_error($error, E_USER_WARNING);
        }
    }
    public function printJsonObject(){
    return json_encode(['width' => $this->width,
    'height' => $this->height,
    'area' => $this->shapeArea(),
    'perimeter'=> $this->shapePerimeter(),
     ]);
    }
}

class Rectangle extends Shape
{
    protected $length;

    public function __construct($width, $height,$length)
    {
        parent::__construct($width, $height);
        $this->length = $length;
    }


    public function shapeArea(): float|int
    {
        $error = "IMPOSSIBLE";
        // TODO: A= w * l
        if($this->width>0) {
            return $this->width * $this->length;
        }
        else{
        return trigger_error($error, E_USER_WARNING);
        }
    }

    public function shapePerimeter(): float|int
    {
        $error = "IMPOSSIBLE";
        //TODO: P=2(l+w)
        if($this->width>0) {
            return 2 * ($this->length + $this->width);
        }
        else{
            return trigger_error($error, E_USER_WARNING);
        }
    }
    public function printJsonObject(){
        return json_encode(['width' => $this->width,
            'height' => $this->height,
            'area' => $this->shapeArea(),
            'perimeter'=> $this->shapePerimeter(),
        ]);
    }
}

class JustOneOrdinaryShape extends Shape
{
    public function shapeArea(): float|int
    {
        // TODO: Implement shapeArea() method.
        return ($this->width * $this->height + 4);
    }

    public function shapePerimeter()
    {
        // TODO: Implement shapePerimeter() method.
        return ($this->width + $this->height + 19);
    }
    public function printJsonObject(){
        return json_encode(['width' => $this->width,
            'height' => $this->height,
            'area' => $this->shapeArea(),
            'perimeter'=> $this->shapePerimeter(),
        ]);
    }
}


$triangle1 = new Triangle("1","10","7", "8", "9");
echo $triangle1->shapeArea()."\n";
echo $triangle1->printJsonObject();
$triangle2 = new Triangle("14","15","16", "17", "18");
$triangle3 = new Triangle("3","5","4", "5", "3");
$ordinaryShape = new JustOneOrdinaryShape("0","15");
echo $ordinaryShape->printJsonObject();
$rectangle1 = new Rectangle("4","5","6");
$rectangle2 = new Rectangle("2","8","14");
$rectangle3 = new Rectangle("3","7","6");
