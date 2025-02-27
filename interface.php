<?php
// 定义一个接口
interface car
{
    // 接口中的方法必须是抽象的
    public function makeSound(); // 汽车按喇叭
    public function move();      // 汽车移动
}
//实现接口
class BMW implements Car{
    public function makeSound(){
        return "滴~滴~";
    }
    public function move(){
        return "start!";
    }
}
$bmw = new BMW();
echo $bmw->makeSound().PHP_EOL;
echo $bmw->move().PHP_EOL;
