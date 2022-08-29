<?php

// define a class
class InitiateClass {
    // put some constructor here
    public function __construct($name, $param)
    {
        $this->name = $name;
        $this->param = $param;
    }
    // put some public method here
    public function goto()
    {
        echo $this->viewto().'<br>'.
             $this->name.'<br> public method running'; // only access inside the class
    }
    // put some protected method here
    protected function viewto()
    {
        echo $this->param.'<br> private method initiating';
    }
    // put some private method here
    private function privateViewto()
    {
        echo $this->param.'<br> private method initiating';
    }
    // put some static method here
    static function staticMethod()
    {
        echo '<br> static method initiating';
    }
}

// define a child class
class ChildInitiateClass extends InitiateClass {
    // put some protected method here
    protected function viewto()
    {
        echo strtoupper($this->param); // override the protected return value of parent class
    }
}
// define another child class
class AnotherChildInitiateClass extends InitiateClass {
    // write some code
}

// call the parent object
$obj1 = new InitiateClass("zaman", "just testing");

// call the child object
$obj2 = new ChildInitiateClass("zaman shovon", "just testing"); // overriding the value by changing value
$obj3 = new AnotherChildInitiateClass("zaman shovon", "just testing"); // overriding the value by changing value

// call the object/class method
echo $obj1->goto().'<br><br>'; // initiate all method
echo $obj2->goto().'<br><br>'; // initiate public and protected method
echo $obj3->goto().'<br>'; // initiate public and protected method

// call static method of parent from child
echo $obj2::staticMethod(); // it can be called by arrow (->) $obj2->staticMethod()

// Method exists checked
// if (method_exists('InitiateClass','gotos'))
//     echo 'Exists';
// else
//     echo 'Not Exists';
