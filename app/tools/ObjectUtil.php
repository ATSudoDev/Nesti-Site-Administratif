<?php

class ObjectUtil{
    public static function get($object, $propertyName){
        return $object->{'get' . ucFirst($propertyName)}();
    }

    public static function set(&$object, $propertyName, $propertyValue){
        return $object->{'set' . ucFirst($propertyName)}($propertyValue);
    }

    public static function setFromArray(&$object, $properties){
        foreach( $properties as $propertyName=>$propertyValue){
            static::set($object,$propertyName,$propertyValue);
        }
    }

    
}