<?php 

interface BookManagement {
    public function addAuthor (string $authorName); //надо ли Public?
    public function getAuthorsArray() : array;
    public function getAuthors() : string;
    public function takeBook($readerID = null) : string;
}


abstract class Book implements BookManagement {
    protected string $name;
    protected array $authors;
    protected int $id;

    public function __construct(string $bookname) {
        $this->name = $bookname;
        $this->authors = array();
    }

    public function addAuthor (string $authorName){
        array_push($this->authors, $authorName);
    }

    public function getName() : string {
        return $this->name;
    }

    public function getAuthorsArray() : array {
        return $this->authors;
    }

    public function getAuthors() : string {
        $str = '';
        foreach($this->authors as $aut){
            $str = $str.$aut.' ';
        }
        return $str;
    }

    public function setID (int $value) {
        $this->id = $value;
    }

    public function getID() : int {
        return $this->id;
    }

}

class RealBook extends Book {    
    private int $pagesCount;    
    private int $shelfld;
    private bool $accessible;
    private string $readerName;
    public function __construct(string $bookname, int $pcount) {
        parent::__construct($bookname);
        $this->pagesCount = $pcount;
        $this->accessible = true;
    }

    public function takeBook($value = null) : string {
        if ($this->accessible == false) {
            return "Книга на руках у {$this->readerName}";
        }
        $this->readerName = $value;
        $this->accessible = false;
        $this->shelfld = -1;
        return "Книга выдана {$value}";
    }

    public function giveBook($shelfld): void {
        $this->shelfld = $shelfld;
        $this->accessible = true;
        $this->readerName = null; //МБ лучше пустую строку
    }

    public function getShelfId() : int {
        return $this->shelfld;
    }

    public function setShelfId (int $value) : void {
        $this->shelfld = $value;
    }

    }
    class DigitalBook extends Book { 
        private string $link;
        public function getLink() : string {
            return $this->link;
        }

        public function setLink(string $value) : void {
            $this->link = $value;
        }
        public function takeBook($value = null) : string {
            return "Ваша ссылка: {$this->link} ";
        }
    }
?>