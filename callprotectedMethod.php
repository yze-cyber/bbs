<?php
//父类
class ParentClass
{
    // 定义一个受保护的方法
    protected function pM()
    {
        return "受保护的方法";
    }
    //访问方法一：通过类内部的公共方法访问受保护的方法
    public function usepM()
    {
        echo $this->pM().PHP_EOL;
    }
}
$parent = new ParentClass();
$parent->usepM();
// 子类，继承自父类
class ChildClass extends ParentClass
{
    // 访问方法二：通过子类的公共方法访问父类的受保护方法
    public function useFpM()
    {
        return $this->pM();
    }
}
$child = new ChildClass();
echo $child->useFpM().PHP_EOL;
