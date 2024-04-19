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


class Interval
{

    private $start;
    private $end;

    public function setStart($startTime)
    {
        $this->start = strtotime($startTime);
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setEnd($endTime)
    {
        $this->end = strtotime($endTime);
    }

    public function getEnd()
    {
        return $this->end;
    }
}

function stringToInterval(string $l): Interval
{
    $times = explode("-", $l);
    $start_time = $times[0];
    $end_time = $times[1];
    $interval = new Interval();
    $interval->setStart($start_time);
    $interval->setEnd($end_time);


    return $interval;
}


function addTimeInterval(array $list, string $newInterval): bool
{

    foreach ($list as $interval) {

        [$start, $end] = explode('-', $interval);
        $start_time = $start[0];
        $end_time = $end[1];
        $interval = new Interval();
        $interval->setStart($start_time);
        $interval->setEnd($end_time);

        [$newStart, $newEnd] = explode('-', $newInterval);
        $start_time = $newStart[0];
        $end_time = $newEnd[1];
        $interval = new Interval();
        $interval->setStart($start_time);
        $interval->setEnd($end_time);

        if (($newStart >= $start && $newStart < $end) || ($newEnd > $start && $newEnd <= $end)) {
            return false;
        }
    }
    return true;
}


function checkingTimeInterval(Interval $interval): bool
{

    if ($interval->getStart() !== null && $interval->getEnd() !== null) {
        if ($interval->getStart() < $interval->getEnd()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$newInterval = '13:00-15:00';

if (checkingTimeInterval(stringToInterval($newInterval))){

    echo "Интервал валиден\n";
    if (addTimeInterval($list, $newInterval)){

        echo "Новый интервал добавлен\n";
    } else {
        echo "Новый интервал пересекается с существующим интервалом\n";
    }
} else {
    echo "Интервал  не валиден\n";
}

