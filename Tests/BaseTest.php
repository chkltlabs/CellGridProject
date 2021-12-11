<?php

namespace Tests;

class BaseTest {

    public static function run(){
        $methods = get_class_methods(static::class);
        foreach($methods as $methodName){
            if($methodName == 'run'){
                continue;
            }
            try{
                $result = static::$methodName();
                if($result === true){
                    print("$methodName ran successfully\n");
                }else if($result === false){
                    print("$methodName failed...\n");
                }else {
                    print("$methodName returned no result\n");
                }
            }catch(\Exception $e){
                print("$methodName threw an exception: " . $e->getMessage() . "\n");
            }
        }
    }
}