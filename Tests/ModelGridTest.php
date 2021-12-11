<?php

namespace Tests;

use Models\Grid;

class ModelGridTest extends BaseTest{

    //test methods return true on success, false otherwise
    public static function testCalculateNeighborFacts(){
        $gridArray = [
            [1,1,0,2],
            [0,1,0,0],
            [0,2,0,0],
        ];
        $facts = \Models\Grid::calculateNeighborFacts($gridArray, 1,1);
        //cell 1,1 is expected to have 3 neighbors, one of which is an adult.
        return ($facts['neighborCount'] == 3 && $facts['adultNeighborCount'] == 1);
    }

    public static function testCalculateNewValues(){
        //uses example from instructions.docx
        $gridArray = [
            [0,0,1,0,0],
            [0,0,1,1,0],
            [0,2,2,1,0],
            [0,0,0,1,0],
            [0,0,0,0,0],
        ];

        $expected = [
            [0,0,2,0,0],
            [0,1,0,2,0],
            [0,3,0,2,0],
            [0,1,1,2,0],
            [0,0,0,0,0],
        ];

        $grid = new Grid($gridArray);
        $actual = $grid->nextGrid()->cellArray;
        return serialize($expected) === serialize($actual);
    }

    public static function testApplyRulesToFindNewValue(){

    }

}