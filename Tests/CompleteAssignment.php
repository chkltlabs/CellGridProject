<?php

namespace Tests;

use Models\Grid;

class CompleteAssignment extends BaseTest {

    public static function completeAssignment(){
        $start = [
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,1,1,0,0,0,0,0,0],
            [0,0,0,0,2,0,0,0,0,0],
            [0,0,0,1,2,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,1,0,0,0,0,0,0,0],
            [0,2,1,0,0,0,0,0,0,0],
            [0,2,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
        ];
        $generation = 1;
        print("Calculating Completed solution: What will this grid look like in generation 20?\n");
        $grid = new Grid($start);
        print $grid->toString();
        while($generation <= 20){
            $grid = $grid->nextGrid();
            print("Generation $generation\n");
            print $grid->toString();
            $generation++;
        }

        return true; //completes test
    }
}