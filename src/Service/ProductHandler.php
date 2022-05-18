<?php

namespace App\Service;

use DateTime;

class ProductHandler
{
    public function GetTotalPrice($data)
    {
        if (!is_array($data)) return 0;

        $total = 0;
        foreach ($data as $v) {
            $price = $v['price'] ?: 0;
            $total += $price;
        }

        return $total;
    }

    public function SortProductData($data, $type="")
    {
        if (!is_array($data)) return $data;

        if (strlen($type) >0) {
            $tData = [];
            foreach ($data as $v) {
                if ($v["type"] == $type) {
                    $tData[] = $v;
                }
            }
            $data = $tData;
        }

        array_multisort(array_column($data, "price"), SORT_DESC, $data);

       return $data;
    }

    public function TransferDate($date)
    {
        date_default_timezone_set("Asia/Shanghai");
        return strtotime($date);
    }
}