<?php

namespace Tests;

use Models\Grid;

class PredeterminedTestCases extends BaseTest{

    //This class contains only those test cases explicitly given by the assignment

    public static function testCase1(){
        $start = [
            [0,0,2,2,0,0,0,0,0,0],
            [0,0,0,0,1,3,1,0,0,0],
            [0,0,0,2,0,3,0,0,1,3],
            [0,0,0,0,1,3,0,0,0,3],
            [0,2,2,0,0,0,1,3,1,0],
            [0,0,0,0,0,2,2,0,0,0],
            [0,0,2,0,2,0,0,0,0,0],
            [0,0,0,0,2,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
        ];

        $expected = [
            [0,0,3,3,0,0,0,0,0,0],
            [0,0,0,0,2,0,2,0,0,0],
            [0,0,0,3,0,0,0,0,2,0],
            [0,1,0,1,2,0,0,0,0,0],
            [0,3,3,0,0,1,2,0,2,0],
            [0,0,0,0,1,0,0,0,0,0],
            [0,0,0,0,3,0,1,0,0,0],
            [0,0,0,0,3,1,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
        ];

        $grid = new Grid($start);
        $next = $grid->nextGrid();

        return serialize($expected) === serialize($next->cellArray);
    }

    public static function testCase2(){
        $start = [
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,1,1,0,0,2,0,0,0],
            [0,0,3,3,2,0,0,0,2,0],
            [0,1,0,0,0,0,0,0,2,0],
            [0,0,3,0,0,1,2,0,0,0],
            [0,0,1,3,3,3,0,0,0,0],
            [0,0,0,1,0,1,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
        ];

        $expected = [
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,2,2,0,1,0,1,0,0],
            [0,0,0,0,3,1,0,0,3,1],
            [0,2,0,0,0,1,0,0,3,1],
            [0,0,0,0,0,2,3,1,0,0],
            [0,0,2,0,0,0,0,0,0,0],
            [0,0,0,2,0,2,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
        ];

        $grid = new Grid($start);
        $next = $grid->nextGrid();

        return serialize($expected) === serialize($next->cellArray);
    }

    public static function testCase3(){
        $start = [
            [0,0,0,0,1,3,1,0,0,0],
            [0,0,0,0,0,3,0,0,0,0],
            [0,0,2,0,0,0,0,3,1,0],
            [0,0,2,0,2,3,0,0,3,0],
            [0,0,2,0,0,0,0,3,0,0],
            [0,0,0,0,0,2,1,3,1,0],
            [0,0,0,0,2,2,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
        ];

        $expected = [
            [0,0,0,0,2,0,2,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,1,3,0,0,0,0,0,2,0],
            [0,0,3,0,3,0,0,0,0,0],
            [0,1,3,0,1,1,0,0,0,0],
            [0,0,0,1,0,0,2,0,2,0],
            [0,0,0,0,3,0,1,0,0,0],
            [0,0,0,0,1,1,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0],
        ];

        $grid = new Grid($start);
        $next = $grid->nextGrid();

        return serialize($expected) === serialize($next->cellArray);
    }


}