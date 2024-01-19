<?php

namespace App\Repository;
use App\Entity\Pizza;
use Core\Attributes\Table;
use Core\Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(name: Pizza::class)]
class PizzaRepository extends Repository
{
    public function save($object):void{
        $reflection = new \ReflectionClass(get_class($object));
        if (!$reflection->getNamespaceName() == "App\Entity"){
            throw new \Exception("Entity not found");
        }
        $props = $reflection->getProperties();
        $sql = "INSERT INTO $this->tableName SET (";
        $toBeUsed = [];
        $theIdLine = [];
        foreach ($props as $prop){
            foreach ($prop->getAttributes() as $attribute) {
                if ($attribute->getName() == "App\Entity\Column"){
                    $toBeUsed[]=$prop;
                }elseif($attribute->getName()=="App\Entity\Id"){
                    $theIdLine[]=$prop;
                }
            }
        }
        if ($theIdLine){
            foreach ($theIdLine as $item){
                $index = $item->getName();
                $sql.="$index = :$index ,";
                $getter = "get".ucfirst($index);
                $tabeauExecutable = ['id'=>$object->$getter(),];
            }
        }
        foreach ($toBeUsed as $item){
            $index = $item->getName();
            $sql.="$index = :$index ,";
            $getter = "get".ucfirst($index);
            $tabeauExecutable[] = "$index = ".$object->$getter().',';
        }
        $query = $this->pdo->prepare($sql);
//        $query->execute($tabeauExecutable);
        //retpurner pizzarepo avec id
    }
}