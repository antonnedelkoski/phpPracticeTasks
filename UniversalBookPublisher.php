<?php
//The publishing house “Universal” publishes online and printed books. Every book has an ISBN
//number, title, author and basic price (in dollars).
//For every online book we additionally know its download url and file size (in MB), and for the
//printed book we additionally know its weight (in kg) and if it is in stock.
//The class hierarchy that represents the books should contain an abstract class.
//For every book the following methods should exist:
//- calculatePrice() for calculating the price of the book in the following ways:
//1. For online books, the price increases for 20% from the basic price if the book is larger
//than 20MB
//2. For printed books, the price increases for 15% from the basic price if the weight of the
//book is bigger than 0.7kg
//Add the following two services:
//1. Printing service: Service that formats the output of data for a given book. The output
//should look like this:
    //1. Online book
    //ISBN: 394830
    //Title: “The Red Book”
    //Author: Carl Gustav Jung
    //Basic price: 24.99
// Remember, Sale price is not always the same as basic price
//2. Comparing service: Service that compares 2 books of any kind and prints out on the
//screen which book is cheaper (the printing in this step should use the service in the
//previous step)

//  Moreover, all of the printed books are stored in libraries. Each library is defined with it’s name,
//location and list of books that are currently in that library. Also, each library has it’s
//Employees that have name, surname, sex and MBR(матичен број). When a library is
//created, it has to have at least one book and at least one employee. If not, an error should be
//shown saying “There has to be an employee and a book so that {library_name} can be
//opened.” Also, each library should provide info for the most expensive book, least expensive
//book and the total value of the books in the library. Write a function (outside of the classes)
//which will receive an array of libraries and will return the name of the library that has at least
//one male and one female employee. If there are multiple libraries that have them, return the
//name of the one which has the most valuable book collection.
//Write your own test cases in order to test all of the mentioned functionalities

abstract class Books
{
    protected $isbn;
    protected $title;
    protected $author;
    protected float $basic_price;

    public function __construct($isbn, $title,$author, $basic_price)
    {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->author = $author;
        $this->basic_price = $basic_price;
    }

     abstract public function calculatePrice();
    abstract public function printBook();

    public function getName(){
        return $this->title;
    }
}

class OnlineBooks extends Books
{
    protected string $downloadUrl;
    protected int $fileSize;

    public function __construct($isbn, $title,$author, $basic_price,$downloadUrl, $fileSize)
    {
        parent::__construct($isbn, $title,$author, $basic_price);
        $this->downloadUrl = $downloadUrl;
        $this->fileSize = $fileSize;
    }


    public function calculatePrice(): float
    {
        if($this->fileSize > 20) {
            return $this->basic_price * 1.20;
        }
      else {
          return $this->basic_price * 1.00;
      }
    }

    public function printBook(): void
    {
        echo "Online book\n
        ISBN: $this->isbn \n
        TITLE: $this->title \n
        AUTHOR: $this->author \n";
    }

}

class PrintedBooks extends Books
{
    protected float $weight;
    protected  bool $stock = false;


    public function __construct($isbn, $title,$author, $basic_price,$weight, bool $stock)
    {
        parent::__construct($isbn, $title,$author, $basic_price);
        $this->weight = $weight;
        $this->stock = $stock;
    }


    public function calculatePrice(): float
    {
        if($this->weight > 0.7){
            return $this->basic_price * 1.15;
        }
        else {
            return $this->basic_price * 1.00;
        }
    }

    public function printBook(): void
    {
        echo "\t\tOnline book\n
        ISBN: $this->isbn \n
        TITLE: $this->title \n
        AUTHOR: $this->author \n
        ";
    }
}

class Library
{
    protected $name;
    protected $location;
    protected $books = [];
    protected $employees = [];

    public function __construct($name, $location)
    {
        $this->name = $name;
        $this->location = $location;
    }

    public function getLibraryName()
    {
        return $this->name;
    }
    public function addBook(Books $book)
    {
        $this->books[] = $book;
    }

    public function addEmployee(Employees $employee)
    {
        $this->employees[] = $employee;
    }

    public function getBooks()
    {
        return $this->books;
    }

    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @throws Exception
     */
    public function checkBooksAndEmployees()
    {
        if((count($this->books) == 0) && (count($this->employees)))
        {
           throw new Exception('There has to be an employee and da book so that'.$this->getLibraryName().' can be opened');
        }
        return true;
    }


    public function getMostExpensiveBook(){
       $this->checkBooksAndEmployees();
       $max = 0;
       $nameMax = '';
       foreach($this->books as $book)
       {
           if($max < $book->calculatePrice()){
               $max = $book-> calculatePrice();
               $nameMax = $book->printBook();
           }
       }
       return 'Most expensive book is' .$nameMax . ' ';
    }
    public function getLeastExpensiveBook(){
        $this-> checkBooksAndEmployees();
        $min = 999999;
        $nameMin = '';
        foreach($this->books as $book)
        {
            if( $min > $book->calculatePrice()){
                $min = $book->calculatePrice();
                $nameMin = $book ->printBook();
            }
        }
        return 'Most expensive book is' .$nameMin . ' ';
    }

    public function getTotalBooksValue(): float
    {
        $total = 0;

        /** @var PrintedBooks $book */
        foreach ($this->books as $book) {
            $total = $book->calculatePrice();
        }
        return $total;
    }
}

class Employees
{
    protected $empName;
    protected $empSurname;
    protected $empSex;
    protected $empEmbg;

    public function __construct($empName, $empSurname, $empSex,$empEmbg)
    {
        $this->empName = $empName;
        $this->empSurname = $empSurname;
        $this->empSex = $empSex;
        $this->empEmbg = $empEmbg;
    }

    public function getName() : string{
        return $this-> empName;
    }

    public function getSurname() : string{
        return $this-> empSurname;
    }

    public function getSex() : string{
        return $this-> empSex;
    }

    public function getEmbg() : string{
        return $this-> empEmbg;
    }
}
// initializing books array with printed and online books.
$books =  array();
$Book1 = new PrintedBooks("1234567","For whom the bells toll", "Ernest Hemingway",12.66,3.0,1);
$books[] = $Book1;
$Book2 = new PrintedBooks("1234567","Return of the King", "J.R.R Tolkien",10.68,1.6,1);
$books[] = $Book2;
$Book3 = new PrintedBooks("1234567","Battle of the five armies", "J.R.R Tolkien",10.69,1.2,1);
$books[] = $Book3;
$Book4 = new PrintedBooks("1234567","The hobbit", "J.R.R Tolkien",10.77,0.3,0);
$books[] = $Book4;
$Book5 = new OnlineBooks("1234567","Fellowship of the ring", "J.R.R Tolkien",10.44,"www.flshpring.com/chapter1.pdf",14);
$books[] = $Book5;
$Book6 = new OnlineBooks("1234567","War and peace", "Leo Tolstoy",10.99,"www.leobooks.com/chapter1.pdf",34);
$books[] = $Book6;
$Book7 = new OnlineBooks("1234567","Anna Karenina", "Leo Tolstoy",10.34,"www.leobooks.com/chapter1.pdf",82);
$books[] = $Book7;
$Book8 = new PrintedBooks("1234567","Feast of crows", "Ernest Hemingway",10.54,"0.9",0);
$books[] = $Book8;
$Book9 = new PrintedBooks("1234567","Lolita", "Vladimir Nabokov",10.12,0.8,1);
$books[] = $Book9;
$Book10 = new PrintedBooks("1234567","Ulysses", "James Joyce",10.33,0.6,0);
$books[] = $Book10;
//comparing two randomly selected books from the books array and checking which one is cheaper.
function compareTwoRandomBooks($books)
{
    $keys = array_rand($books,2);

    $randomBook1 = $keys[0];
    $randomBook2 = $keys[1];

    $priceBook1 = $books[$randomBook1]->calculatePrice();
    $priceBook2 = $books[$randomBook2]->calculatePrice();

    $nameBook1 = $books[$randomBook1]->getName();
    $nameBook2 = $books[$randomBook2]->getName();

    if($priceBook1 > $priceBook2){
        echo "Book \"$nameBook2\" is cheaper than the book \"$nameBook1\"\n";
    }
    else if($priceBook2 > $priceBook1){
        echo "Book \"$nameBook1\" is cheaper than the book \"$nameBook2\"\n";
    }
    else{
        echo "Books: $nameBook1 and $nameBook2 have the same price\n";
    }
}

//checking which library that contains male and female workers and has a book in it has the highest value of books.
function librariesTasks(array $libraries)
{
    $males = 0;
    $females = 0;
    $maxValue = 0;
    $totalName = '';

    foreach ($libraries as $library) {
        if ($maxValue < $library->getTotalBooksValue()) {
            $maxValue = $library->getTotalBooksValue();
            $totalName = $library->getLibraryName();
        }
        foreach ($library->getEmployees() as $employee) {
            if (($employee->getSex() == 'MALE') && $employee->getSex() == 'FEMALE') {
                $males++;
                $females++;
                if ($males >= 1 && $females >= 1)
                    return $library->getLibraryName();
                else
                    return 'There is no such library';
            }
              return 'The name of the library with the most valuable book collection is ' . $totalName;
            }
        }
        return 'There is no such library';
}

    foreach ($books as $book) {
        $newPrice = $book->calculatePrice();
        $formattedPrice = number_format($newPrice, 2, '.', '');
        $book->printBook();
        echo
        "PRICE: $$formattedPrice\n
        --------------------\n \n";
    }

//initializing objects to test the previous functions.
$library = new Library('biblioteka', 'ohrid');
$books =  array();
$book = new PrintedBooks("1234567","For whom the bells toll", "Ernest Hemingway",12.66,3.0,1);
$library->addBook($book);
$book = new PrintedBooks("1234567","Return of the King", "J.R.R Tolkien",10.68,1.6,1);
$library->addBook($book);
$book = new PrintedBooks("1234567","Battle of the five armies", "J.R.R Tolkien",10.69,1.2,1);
$library->addBook($book);
$book = new PrintedBooks("1234567","The hobbit", "J.R.R Tolkien",10.77,0.3,0);
$library->addBook($book);

$employee = new Employees("Jovan",'Kukuzel','M','1234567');
$employees = array();
$library1 = new Library('Brakja Miladinovi', 'Karpos');
$library2 = new Library('1000 knigi', 'Centar');

$library1-> addBook($Book1);
$library1-> addBook($Book2);

$employee1 = new Employees('Bojan', 'Mirov', 'male', '001651321645');
$employee2 = new Employees('Borce', 'Nikolova', 'female', '65435185465');

$employee3 = new Employees('Stefan', 'Todorov', 'male', '35435135400');
$employee4 = new Employees('Elisaveta', 'Savevska', 'female', '65454684351');

$book11 = new PrintedBooks(919183, 'White', 'Kocho ', 27.99, 5.00, 1);
$book12 = new PrintedBooks(9193, 'Dawns', 'Racin', 32.99, 2.00, 1);

$library2-> addEmployee($employee3);
$library2-> addEmployee($employee4);

$library2-> addBook($book11);
$library2-> addBook($book12);
$library1-> addEmployee($employee1);
$library1-> addEmployee($employee2);

$libraries = [$library,$library1, $library2];

echo librariesTasks($libraries);
compareTwoRandomBooks($books);