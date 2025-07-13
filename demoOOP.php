<?php
class Person {
    public $name;
    public $age;
    public $address;

    public function  Name($name) {
        $this->name = $name;
    }
    public function Age($age) {
        $this->age = $age;
    } 
    public function Address($address) {
        $this->address = $address;
    }
}

$p = new Person();
$p->Name("Nguyen Van A");
$p->Age(20);
$p->Address("Ha Noi");  
echo "name=$p->name<br/>";
echo "age=$p->age<br/>";
echo "address=$p->address<br/>";



class Member
{
    public $name;
    public $roles = [];

    public function __construct($name)
    {
        $this->name = $name;
        $this->initRoles();
    }

    public function initRoles()
    {
        // Default roles for Member, can be empty or basic roles
        $this->roles = ['view_post'];
    }

    public function listRoles()
    {
        echo "Roles of {$this->name}:<br/>";
        foreach ($this->roles as $role) {
            echo "- $role<br/>";
        }
    }
}

class Administrator extends Member
{
    public function initRoles()
    {
        $this->roles = [
            'manage_user', 'edit_role', 'edit_post',
            'delete_user', 'view_post', 'delete_post'
            
        ];
    }
}

$user_a = new Administrator('Mr A');
$user_a->listRoles();