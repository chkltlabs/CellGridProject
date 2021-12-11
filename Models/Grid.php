<?php

namespace Models;

class Grid {

    public $cellArray;

    public function __construct($gridObjectOrArray = [])
    {
        if($gridObjectOrArray instanceof self){
            //argument to constructor is the previous grid, use to calculate new grid
            $this->calculateNewValues($gridObjectOrArray);
        }else{
            //validate the array is 2 dimensional, and filled with numerical values
            foreach($gridObjectOrArray as $rowKey => $row){
                if(!is_array($row)){
                    throw new \Exception(
                        "Row $rowKey in input was not an array, \n
                        and is therefore disallowed. \n
                        Try again.\n"
                    );
                }
                foreach($row as $columnKey => $itemInRow){
                    if(!is_numeric($itemInRow) && $itemInRow != null){
                        throw new \Exception(
                            "Value given for row $rowKey, column $columnKey \n
                            was not numeric or null, and is therefore disallowed. \n
                            Try again.\n
                             Value given: $itemInRow\n");
                    }
                    if(is_numeric($itemInRow) && !in_array($itemInRow, [0,1,2,3])){
                        throw new \Exception(
                            "Value given was numeric, but not in the \n
                            allowed range of values (0-3, whole integers only)\n
                            Try again.\n"
                        );
                    }
                    //todo: add exception for uneven row lengths
                }
            }
            //argument to constructor is a valid array of starting values
            $this->setValues($gridObjectOrArray);
        }
    }

    public function nextGrid(){
        return new self($this);
    }

    public function setValues($valueArray){
        $this->cellArray = $valueArray;
    }

    public function calculateNewValues(self $previousGridObject){
        $oldCells = $previousGridObject->cellArray;
        foreach($oldCells as $rowKey => $row){
            foreach($row as $columnKey => $value){
                $neighborFacts = self::calculateNeighborFacts($oldCells, $rowKey, $columnKey);
                $this->cellArray[$rowKey][$columnKey] = self::applyRulesToFindNewValue($value, $neighborFacts);
            }
        }
    }

    public static function calculateNeighborFacts($cellArray, $rowNum, $colNum){
        $height = count($cellArray);
        $width = count($cellArray[0]);
        $rtn = [
            'neighborCount' => 0,
            'adultNeighborCount' => 0,
        ];
        for($y = max($rowNum - 1, 0); $y <= $rowNum + 1 && $y <= $height; $y++){
            for($x = max($colNum - 1, 0); $x <= $colNum + 1 && $x <= $width; $x++){
                if($x == $colNum && $y == $rowNum){
                    //this is the target cell! Skip it!
                    continue;
                }
                if($cellArray[$y][$x] !== 0 && !is_null($cellArray[$y][$x])){
                    //cell is occupied
                    $rtn['neighborCount']++;
                    if($cellArray[$y][$x] == 2){
                        //is an adult
                        $rtn['adultNeighborCount']++;
                    }
                }
            }
        }
        return $rtn;
    }

    public static function applyRulesToFindNewValue($oldValue, $neighborFacts){
        $newValue = 0;
        switch ($oldValue){
            case 0:
                if($neighborFacts['adultNeighborCount'] === 2){
                    $newValue = 1;
                }
                break;
            case 1:
                if($neighborFacts['neighborCount'] < 5
                    && $neighborFacts['neighborCount'] > 1){
                    $newValue = 2;
                }
                break;
            case 2:
                if($neighborFacts['neighborCount'] < 3
                    && $neighborFacts['neighborCount'] != 0){
                    $newValue = 3;
                }
                break;
            case 3:
                //we all gotta die sometime, pal.
                break;
        }
        return $newValue;
    }


    public function toString(){
        $rtn = '';
        foreach($this->cellArray as $rowKey => $row){
            $zeroedRow = array_map(function($item){
                return (is_null($item)) ? 0 : $item;
            },$row);
            $rtn .= '[';
            $rtn .= implode(',', $zeroedRow);
            $rtn .= "] \n";
        }
        return $rtn;
    }

}