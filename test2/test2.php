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
 *    принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм)
 *    возвращать boolean
 *
 *
 * Вторая функция должна проверять "наложение интервалов" при попытке добавить новый интервал в список существующих
 *    принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм). Учесть переход времени на следующий день
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
 *    "10:00-14:00"
 *    "16:00-20:00"
 *
 *  пытаемся добавить еще один интервал
 *    "09:00-11:00" => произошло наложение
 *    "11:00-13:00" => произошло наложение
 *    "14:00-16:00" => наложения нет
 *    "14:00-17:00" => произошло наложение
 */

# Можно использовать список:

$list = array(
    '09:00-11:00',
    '11:00-13:00',
    '15:00-16:00',
    '17:00-20:00',
    '20:30-21:30',
    '21:30-22:30',
    '22:00-23:00'
);


class Interval
/** Принимаем строку интервала времени, переводим в Unix и отдаем на сравнение */
{

    private $start;
    private $end;

    public function setStart(string $startTime)
    {
        $this->start = strtotime($startTime);
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function setEnd(string $endTime)
    {
        $this->end = strtotime($endTime);
    }

    public function getEnd(): int
    {
        return $this->end;
    }
}

function stringToInterval(string $intervalStr): Interval
/** Разбиваем временной интервал и отправляем на перевод */

{
    $times = explode("-", $intervalStr);
    $startTime = $times[0];
    $endTime = $times[1];

    $interval = new Interval();
    $interval->setStart($startTime);
    $interval->setEnd($endTime);

    return $interval;
}

/** Проверка на наложение временного интервала */
function addTimeInterval(array $list, string $newInterval): bool
{
    [$newStart, $newEnd] = explode('-', $newInterval);
    $startTime = $newStart;
    $endTime = $newEnd;

    $newIntervalObj = new Interval();
    $newIntervalObj->setStart($startTime);
    $newIntervalObj->setEnd($endTime);

    foreach ($list as $interval) {

        [$start, $end] = explode('-', $interval);
        $startTime = $start;
        $endTime = $end;

        $oldInterval = new Interval();
        $oldInterval->setStart($startTime);
        $oldInterval->setEnd($endTime);

        if (($newIntervalObj->getStart() >= $oldInterval->getStart() &&
                $newIntervalObj->getStart() < $oldInterval->getEnd()) ||
            ($newIntervalObj->getEnd() > $oldInterval->getStart() &&
                $newIntervalObj->getEnd() <= $oldInterval->getEnd())) {
            return false;
        }
    }
    return true;
}


function checkingTimeInterval(Interval $interval): bool
/** Проверка на валидность временного интервала */
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

$newInterval = '10:00-15:00';

if (checkingTimeInterval(stringToInterval($newInterval))) {

    echo "Интервал валиден\n";
    if (addTimeInterval($list, $newInterval)) {

        echo "Новый интервал добавлен\n";
    } else {
        echo "Новый интервал пересекается с существующим интервалом\n";
    }
} else {
    echo "Интервал  не валиден\n";
}

