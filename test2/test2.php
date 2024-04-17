<?php
/**
 * @charset UTF-8
 *
 * Задание 2. Работа с массивами и строками.
 *
 * Есть список временных интервалов (интервалы записаны в формате чч:мм-чч:мм).
 *
 * Необходимо написать две функции:
 *
 *
 * Первая функция должна проверять временной интервал на валидность
 * 	принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм)
 * 	возвращать boolean
 *
 *
 * Вторая функция должна проверять "наложение интервалов" при попытке добавить новый интервал в список существующих
 * 	принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм). Учесть переход времени на следующий день
 *  возвращать boolean
 *
 *  "наложение интервалов" - это когда в промежутке между началом и окончанием одного интервала,
 *   встречается начало, окончание или то и другое одновременно, другого интервала
 *
 *
 *
 *  пример:
 *
 *  есть интервалы
 *  	"10:00-14:00"
 *  	"16:00-20:00"
 *
 *  пытаемся добавить еще один интервал
 *  	"09:00-11:00" => произошло наложение
 *  	"11:00-13:00" => произошло наложение
 *  	"14:00-16:00" => наложения нет
 *  	"14:00-17:00" => произошло наложение
 */

# Можно использовать список:

$list = array (
    '09:00-11:00',
    '11:00-13:00',
    '15:00-16:00',
    '17:00-20:00',
    '20:30-21:30',
    '21:30-22:30',
    '22:00-23:00'
);

class Interval {
    public $start;
    public $end;
}


function stringToTime(string $l): object
{
   $times = explode("-", $l);
   $start_time = $times[0];
   $end_time = $times[1];
   $obj = new Interval();
   $obj->start = strtotime($start_time);
   $obj->end = strtotime($end_time);


   return $obj;
}


function checkingTimeInterval( $timeInterval): string
{

    if ($timeInterval ->start !== null && $timeInterval ->end !== null) {
        if ($timeInterval ->start < $timeInterval ->end) {

            return true;
//            return "Интервал времени валиден";

        } else {
//            return "Конечное время должно быть больше начального";
            return false;
        }
    } else {
//        return "Интервал времени невалиден";
        return false;
    }
}

if (checkingTimeInterval(stringToTime('55:90-61:89'))){

    echo 'interval valid';
} else {
    echo 'interval not valid';
}

//function checkInterval ($enterInterval){
//    $ok = preg_match('/^([01][0-9]|2[0-3])(:)[0-5][0-9](-)([01][0-9]|2[0-3])(:)[0-5][0-9]$/', $enterInterval);
//    if(!$ok)
//    {
//        return false;
//    }
//    return true;
//}
//function checkAddInterval ($enterInterval){
//    global $list;
//    $enterIntervals = explode ("-", $enterInterval);
//    foreach ($enterIntervals as $j => $enterInt){
//        if ($j == 0){
//            $enterIntervalStart = strtotime($enterInt);
//        }
//        else {
//            $enterIntervalEnd = strtotime($enterInt);
//        }
//    }
//    foreach ($list as $timeInt){
//        $intervals = explode ("-", $timeInt);
//        foreach ($intervals as $i => $interval){
//            if ($i == 0){
//                $intervalStart = strtotime($interval);
//            }
//            else {
//                $intervalEnd = strtotime($interval);
//            }
//        }
//        if($intervalStart < $enterIntervalEnd and $intervalEnd > $enterIntervalStart){
//            return false;
//        }
//        else{
//            return true;
//        }
//    }
//}
//
//if (checkAddInterval('22:00-23:00')) {
//    echo "ok";
//
//} else {
//    echo "not ok";
//}
//
//if (checkInterval('22:00-23:00')) {
//    echo "ok";
//
//} else {
//    echo "not ok";
//}