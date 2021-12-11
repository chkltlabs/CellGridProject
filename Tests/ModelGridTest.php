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
        //all tests must be true to pass

        //cell is empty
        //does not have 2 adults
        return (Grid::applyRulesToFindNewValue(0, ['neighborCount' => 2, 'adultNeighborCount' => 1]) == 0) &&
            //has 2 adults
            (Grid::applyRulesToFindNewValue(0, ['neighborCount' => 2, 'adultNeighborCount' => 2]) == 1) &&
        //cell is infant
            //has 5+ neighbors
            (Grid::applyRulesToFindNewValue(1, ['neighborCount' => 6, 'adultNeighborCount' => 1]) == 0) &&
            //has <2 neighbors
            (Grid::applyRulesToFindNewValue(1, ['neighborCount' => 1, 'adultNeighborCount' => 1]) == 0) &&
            //has 3 neighbors
            (Grid::applyRulesToFindNewValue(1, ['neighborCount' => 3, 'adultNeighborCount' => 1]) == 2) &&
        //cell is adult
            //has 3+ neighbors
            (Grid::applyRulesToFindNewValue(2, ['neighborCount' => 4, 'adultNeighborCount' => 1]) == 0) &&
            //has 0 neighbors
            (Grid::applyRulesToFindNewValue(2, ['neighborCount' => 0, 'adultNeighborCount' => 0]) == 0) &&
            //has 2 neighbors
            (Grid::applyRulesToFindNewValue(2, ['neighborCount' => 2, 'adultNeighborCount' => 1]) == 3) &&
        //cell is elder
            (Grid::applyRulesToFindNewValue(3, ['neighborCount' => 4, 'adultNeighborCount' => 1]) == 0);
    }

    public static function testNonArrayException(){
        try{
            $start = [
                [0,1,2],
                'string',
                [0,0,0]
            ];
            $grid = new Grid($start);
        }catch(\Exception $e){
            return $e->getMessage() == "Row 1 in input was not an array, \n
                        and is therefore disallowed. \n
                        Try again.\n";
        }
        return false;
    }

    public static function testUnevenRowsException(){
        try{
            $start = [
                [0,1,2],
                [],
                [0,0,0]
            ];
            $grid = new Grid($start);
        }catch(\Exception $e){
            return $e->getMessage() == "Row 1 has a different length than \n
                        previously checked rows. (0 vs 3)\n 
                        Your input must be a grid, \n
                        with rows of equal size.\n 
                        Try again.\n";
        }
        return false;
    }

    public static function testNonNumericOrNullException(){
        try{
            $start = [
                [0,1,2],
                [0,'string',2],
                [0,0,0]
            ];
            $grid = new Grid($start);
        }catch(\Exception $e){
            return $e->getMessage() == "Value given for row 1, column 1 \n
                            was not numeric or null, and is therefore disallowed. \n
                            Try again.\n
                             Value given: string\n";
        }
        return false;
    }

    public static function testOutOfAcceptableRangeException(){
        try{
            $start = [
                [0,1,2],
                [0,4,3],
                [0,0,0]
            ];
            $grid = new Grid($start);
        }catch(\Exception $e){
            return $e->getMessage() == "Value given was numeric, but not in the \n
                            allowed range of values (0-3, whole integers only)\n
                            Try again.\n";
        }
        return false;
    }

}