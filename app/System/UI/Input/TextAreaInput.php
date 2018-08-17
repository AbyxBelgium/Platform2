<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\System\UI\Input;


class TextAreaInput extends TextInput
{
    /* @var integer */
    private $rows;

    /**
     * @return int
     */
    public function getRows(): int
    {
        return $this->rows;
    }

    /**
     * @param int $rows
     */
    public function setRows(int $rows): void
    {
        $this->rows = $rows;
    }
}
