<?php

namespace App\Games;


use http\Exception\InvalidArgumentException;

class TicTacToeGame
{

    protected function checkSum($iSum)
    {
        $iResult = 0;
        if (3 == $iSum || 6 == $iSum) {
            $iResult = $iSum/3;
        }

        return $iResult;
    }


    public function haveWinner(array $aTable)
    {
        $aResult = [];
        $iResult = 0;
        foreach ($aTable as $iR => $aRow) {
            //Check vertical lines
            if ($aTable[0][$iR] && $aTable[1][$iR] && $aTable[2][$iR]) {
                $iSum = $aTable[0][$iR] + $aTable[1][$iR] + $aTable[2][$iR];
                if (($iResult = $this->checkSum($iSum))) {
                    break;
                }
            }
            $aResult[] = array_search(0, $aRow);
            $aRow = array_filter($aRow);
            if (count($aRow) < 3) {
                continue;
            }
            $iSum = array_sum($aRow);
            //Check horizontal lines
            if (($iResult = $this->checkSum($iSum))) {
                break;
            }
        }
        $iSum = 0;
        if (!$iResult) {
            //Check diagonals
            if ($aTable[0][0] && $aTable[1][1] && $aTable[2][2]) {
                $iSum = $aTable[0][0] + $aTable[1][1] + $aTable[2][2];
            }
            if (
                !($iResult = $this->checkSum($iSum))
                && ($aTable[0][2] && $aTable[1][1] && $aTable[2][0])
            ) {
                $iSum = $aTable[0][2] + $aTable[1][1] + $aTable[2][0];
            }
            $iResult = $this->checkSum($iSum);
        }
        if (!$iResult) {
            //Check a drawn
            if (
                3 == count($aResult)
                && false === $aResult[0]
                && false === $aResult[1]
                && false === $aResult[2]
            ) {
                return 3;
            }
        }

        return $iResult;
    }

    public function processHumanTurn(array $aTable, string $sTurn)
    {
        $aTurn = explode('_', $sTurn);
        $aTable = $this->processPlayerTurn($aTable, 1, $aTurn);

        return $aTable;
    }

    public function processBotTurn(array $aTable)
    {
        $aCells = [];
        foreach ($aTable as $iR => $aRow) {
            foreach ($aRow as $iC => $aCell) {
                if (!$aCell) {
                    $aCells[] = [$iR, $iC];
                }
            }
        }
        $iIndex = mt_rand(0, count($aCells)-1);
        $aTurn = $aCells[$iIndex];

        return $this->processPlayerTurn($aTable, 2, $aTurn);
    }

    /**
     * Create game
     *
     */
    public function processPlayerTurn(array $aTable, int $iPlayerTurn, array $aCell)
    {
        $val = ($aTable[$aCell[0]][$aCell[1]] ?? null);
        if (is_null($val)) {
            throw new InvalidArgumentException("Cell not found");
        }
        if ($val) {
            return $aTable;
        }
        $aTable[$aCell[0]][$aCell[1]] = $iPlayerTurn;

        return $aTable;
    }

}
