<?php
// app/Helpers/NumberHelper.php
if (!function_exists('padNumber')) {
    /**
     * Pad the given number with zeros to make it 9 digits long.
     *
     * @param int $number The number to pad
     * @return string The padded number
     */
    function padNumber($number)
    {
        return str_pad($number, 9, '0', STR_PAD_LEFT);
    }
}
