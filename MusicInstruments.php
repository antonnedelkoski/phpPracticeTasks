<?php
//Да се креира хиерархиjа на класи за репрезентациjа на жичани инструменти. За потребите на оваа хиерархиjа да се дефинира класа StringsInstrument од коjа ќе бидат изведени двете класи Guitar и Violin.
//Во класата StringsInstrument се чуваат податоци за:
//името на инструментот
//броjот на жици
//основната цена на инструментот.
//За класата Guitar дополнително се чува нејзиниот тип (ACOUSTIC, ELECTRIC & BASS).
//За класата Violin дополнително се чува неjзината големина (број помеѓу 0 и 1 -> да се провери и да се фрли грешка).
//За секоjа изведените класи треба да се дефинираат соодветните конструктори и следните методи:
//price() за пресметување на цената на инструментот
//основната цена на гитарата се зголемува за 15% доколку таа е од типот 'BASS'
//основната цена на виолината се зголемува за 10% ако неjзината големина има вредност 1/4 (0.25), односно за 20% ако неjзината големина има вредност 1 (1.00)
//Да се напише функциjа printInstrument() коjа ќе ги врати податоците за инструментот во JSON формат.
class StringsInstrument
{
    protected $name;
    protected $strings;
    protected $base_price;

    public function __construct($name, $strings, $base_price)
    {
        $this->name = $name;
        $this->strings = $strings;
        $this->base_price = $base_price;
    }

   public function price(){
        return $this->base_price;
    }

   public function printInstrument(){
        return json_encode(['name' => $this->name,
            'number_of_strings' => $this->strings,
            'base_price'=>$this->base_price,
            ]);
   }
}

class Guitar extends StringsInstrument
{
    protected $type;
    public function __construct($name, $strings, $base_price,$type)
    {
        parent::__construct($name,$strings,$base_price);
        $this->type = $type;
    }

    public function price(){
        if($this->type == 'BASS') {
            return $this->base_price * 1.15;
        }
        return parent::price();
    }
}

class Violin extends StringsInstrument
{
    protected $size;
    public function __construct($name, $strings, $base_price,$size)
    {
        parent::__construct($name,$strings,$base_price);
        $this->size = $size;
    }

    public function price()
    {
        $warning = "Invalid size";
        if($this->size < 0 || $this->size > 1) {
            return $warning;
        }
        else{
            if($this->size == 0.25){
                return $this->base_price * 1.10;
            } else if ($this->size == 1.00) {
                return $this->base_price * 1.20;
            }
            return parent::price();
        }
    }
}
$guitar = new Guitar('My Guitar', 6, 500, 'ACOUSTIC');
$violin = new Violin('My Violin', 4, 300, 0.25);

echo $guitar->price(); // Output: 500 (No price increase for ACOUSTIC guitars)
echo $violin->price(); // Output: 330 (10% price increase for size 0.25)

echo $guitar->printInstrument(); // Output: {"name":"My Guitar","number_of_strings":6,"base_price":500}
echo $violin->printInstrument(); // Output: {"name":"My Violin","number_of_strings":4,"base_price":300