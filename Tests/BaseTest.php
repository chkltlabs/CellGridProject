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
                if(static::$methodName()){
                    print("$methodName ran successfully");
                }else{
                    print("$methodName failed...");
                }
            }catch(\Exception $e){
                print("$methodName threw an exception: " . $e->getMessage());
            }
        }
    }
}