<?php
class Book {
    // 书名
    private $title;
    // 作者
    private $author;
    // 国际标准书号
    private $isbn;
    // 是否可借
    private $isAvailable;
    // 数量
    private $num;

    // 构造方法初始化图书
    public function __construct($title, $author, $isbn, $num) {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->num = $num;
        $this->isAvailable = ($num > 0); // 如果数量大于0，则可借
    }

    // 检查是否可借
    public function getIsAvailable() {
        return $this->isAvailable;
    }
    // 借书
    public function borrowBook() {
        if ($this->isAvailable) {
            $this->num--;
            $this->isAvailable = ($this->num > 0); // 更新可借状态
            echo "借《{$this->title}》成功，剩余数量：{$this->num}" . PHP_EOL;
        } else {
            echo "借书失败：《{$this->title}》当前不可借" . PHP_EOL;
        }
    }
    // 还书
    public function returnBook() {
        if (!$this->isAvailable) {
            $this->num++;
            $this->isAvailable = ($this->num > 0); // 更新可借状态
            echo "还《{$this->title}》成功，当前数量：{$this->num}" . PHP_EOL;
        } else {
            echo "还书失败：《{$this->title}》当前未被借出" . PHP_EOL;
        }
    }
    // 返回书籍详细信息
    public function getBookInfo() {
        echo "书名：{$this->title}，作者：{$this->author}，国际标准书号：{$this->isbn}，是否可借：" . ($this->isAvailable ? "可借" : "不可借") . PHP_EOL;
    }
    //返回书名
    public function getTitle(){
        return $this->title;
    }
}
class User {
    // 用户姓名
    private $name;
    // 已借书籍
    private $borrowedBooks;

    // 构造方法
    public function __construct($name) {
        $this->name = $name;
        $this->borrowedBooks = [];
    }

    // 借书
    public function borrowBook(Book $book) {
        if ($book->getIsAvailable()) {
            $this->borrowedBooks[] = $book;
            $book->borrowBook(); // 调用 Book 类的借书方法
        } else {
            echo "借书失败：《{$book->getTitle()}》当前不可借" . PHP_EOL;
        }
    }

    // 还书
    public function returnBook(Book $book) {
        $index = array_search($book, $this->borrowedBooks, true);
        if ($index !== false) {
            array_splice($this->borrowedBooks, $index, 1); // 从已借书籍列表中移除
            $book->returnBook(); // 调用 Book 类的还书方法
        } else {
            echo "还书失败：《{$book->getTitle()}》不在您的已借书籍列表中" . PHP_EOL;
        }
    }

    // 获取用户已借书籍信息
    public function getBorrowedBooks() {
        if (empty($this->borrowedBooks)) {
            echo "{$this->name} 当前没有借任何书籍。" . PHP_EOL;
        } else {
            echo "{$this->name} 已借书籍：" . PHP_EOL;
            foreach ($this->borrowedBooks as $book) {
                echo "- " . $book->getTitle() . PHP_EOL;
            }
        }
    }
    public function getUserName() {
        return $this->name;
    }
}

// 创建书籍对象
$book1 = new Book("PHP编程", "张三", "1234567890", 3);
$book2 = new Book("JavaScript教程", "李四", "0987654321", 1);

// 创建用户对象
$user1 = new User("yze");

// 输出书籍信息
echo "初始书籍信息：" . PHP_EOL;
$book1->getBookInfo();
$book2->getBookInfo();

// 用户借书
echo PHP_EOL . $user1->getUserName() ."借书：" . PHP_EOL;
$user1->borrowBook($book1);
$user1->borrowBook($book2);

// 输出书籍信息
echo PHP_EOL . "借书后书籍信息：" . PHP_EOL;
$book1->getBookInfo();
$book2->getBookInfo();

// 输出用户已借书籍
$user1->getBorrowedBooks();

// 用户还书
echo PHP_EOL .$user1->getUserName() ."还书：" . PHP_EOL;
$user1->returnBook($book1);

// 输出书籍信息
echo PHP_EOL . "还书后书籍信息：" . PHP_EOL;
$book1->getBookInfo();
$book2->getBookInfo();

// 输出用户已借书籍
$user1->getBorrowedBooks();