<?php

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Text to send if user hits Cancel button';
    exit;
} else {
    echo "<p>Hello {$_SERVER['PHP_AUTH_USER']} . </p>";
    echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
}

//PHP_AUTH_USER

ArrayAccess {
/* 方法 */
abstract public boolean offsetExists ( mixed $offset )
abstract public mixed offsetGet ( mixed $offset )
abstract public void offsetSet ( mixed $offset , mixed $value )
abstract public void offsetUnset ( mixed $offset )
}

class obj implements arrayaccess {
    private $container = array();
    public function __construct() {
        $this->container = array(
            "one"   => 1,
            "two"   => 2,
            "three" => 3,
        );
    }
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}

$obj = new obj;

var_dump(isset($obj["two"]));
var_dump($obj["two"]);
unset($obj["two"]);
var_dump(isset($obj["two"]));
$obj["two"] = "A value";
var_dump($obj["two"]);
$obj[] = 'Append 1';
$obj[] = 'Append 2';
$obj[] = 'Append 3';
print_r($obj);

class obj implements arrayaccess {
    public function offsetSet($offset, $value) {
        var_dump(__METHOD__);
    }
    public function offsetExists($var) {
        var_dump(__METHOD__);
        if ($var == "foobar") {
            return true;
        }
        return false;
    }
    public function offsetUnset($var) {
        var_dump(__METHOD__);
    }
    public function offsetGet($var) {
        var_dump(__METHOD__);
        return "value";
    }
}


$obj = new obj;

echo "Runs obj::offsetExists()\n";
var_dump(isset($obj["foobar"]));

echo "\nRuns obj::offsetExists() and obj::offsetGet()\n";
var_dump(empty($obj["foobar"]));

echo "\nRuns obj::offsetExists(), *not* obj:offsetGet() as there is nothing to get\n";
var_dump(empty($obj["foobaz"]));

class obj implements Serializable {
    private $data;
    public function __construct() {
        $this->data = "My private data";
    }
    public function serialize() {
        return serialize($this->data);
    }
    public function unserialize($data) {
        $this->data = unserialize($data);
    }
    public function getData() {
        return $this->data;
    }
}

$obj = new obj;
$ser = serialize($obj);

$newobj = unserialize($ser);

var_dump($newobj->getData());

class Example implements \Serializable
{
    protected $property1;
    protected $property2;
    protected $property3;

    public function __construct($property1, $property2, $property3)
    {
        $this->property1 = $property1;
        $this->property2 = $property2;
        $this->property3 = $property3;
    }

    public function serialize()
    {
        return serialize([
            $this->property1,
            $this->property2,
            $this->property3,
        ]);
    }

    public function unserialize($data)
    {
        list(
            $this->property1,
            $this->property2,
            $this->property3
        ) = unserialize($data);
    }

}

class MyClass implements Serializable {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    public function serialize() {
        echo "Serializing MyClass...\n";
        return serialize($this->data);
    }

    public function unserialize($data) {
        echo "Unserializing MyClass...\n";
        $this->data = unserialize($data);
    }
}

class MyChildClass extends MyClass {
    private $id;
    private $name;

    public function __construct($id, $name, $data) {
        parent::__construct($data);
        $this->id = $id;
        $this->name = $name;
    }

    public function serialize() {
        echo "Serializing MyChildClass...\n";
        return serialize(
            array(
                'id' => $this->id,
                'name' => $this->name,
                'parentData' => parent::serialize()
            )
        );
    }

    public function unserialize($data) {
        echo "Unserializing MyChildClass...\n";
        $data = unserialize($data);

        $this->id = $data['id'];
        $this->name = $data['name'];
        parent::unserialize($data['parentData']);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
}

$obj = new MyChildClass(15, 'My class name', 'My data');

$serial = serialize($obj);
$newObject = unserialize($serial);

echo $newObject->getId() . PHP_EOL;
echo $newObject->getName() . PHP_EOL;
echo $newObject->getData() . PHP_EOL;