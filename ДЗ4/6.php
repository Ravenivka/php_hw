<?php 

class A {
    public function foo() {
    static $x = 0;  //
    echo ++$x;
    }
}
    $a1 = new A();
    $a2 = new A();
    $a1->foo();
    $a2->foo();
    $a1->foo();
    $a2->foo();

    //1234 - переменная Х - переменная класса