<?php

/**
 * @charset UTF-8
 *
 * Задание 3
 * В данный момент компания X работает с двумя перевозчиками
 * 1. Почта России
 * 2. DHL
 * У каждого перевозчика своя формула расчета стоимости доставки посылки
 * Почта России до 10 кг берет 100 руб, все что cвыше 10 кг берет 1000 руб
 * DHL за каждый 1 кг берет 100 руб
 * Задача:
 * Необходимо описать архитектуру на php из методов или классов для работы с
 * перевозчиками на предмет получения стоимости доставки по каждому из указанных
 * перевозчиков, согласно данным формулам.
 * При разработке нужно учесть, что количество перевозчиков со временем может
 * возрасти. И делать расчет для новых перевозчиков будут уже другие программисты.
 * Поэтому необходимо построить архитектуру так, чтобы максимально минимизировать
 * ошибки программиста, который будет в дальнейшем делать расчет для нового
 * перевозчика, а также того, кто будет пользоваться данным архитектурным решением.
 *
 */

# Использовать данные:
# любые


interface CarrierInterface
{
    public function getCost(int $weight): int;
}

class RussianCarrier implements CarrierInterface
{
    const COST_100 = 100;
    const COST_1000 = 1000;

    const WEIGHT_10 = 10;
    public function getCost(int $weight): int
    {
        if($weight <= self::WEIGHT_10){
            return self::COST_100;
        } else {
            return self::COST_1000;
        }
    }
}

class DHLCarrier implements CarrierInterface
{
    const COST_100 = 100;

    public function getCost(int $weight): int
    {
        return $weight * self::COST_100;
    }
}

// Добавление новой компании
//class KomlevIncCarrier implements CarrierInterface
//{
//    const COST_10000 = 10000;
//
//    public function getCost(int $weight): int
//    {
//        return $weight * self::COST_10000;
//    }
//}

//class IPBasarevskiyCarrier implements CarrierInterface
//{
//    const COST_500 = 500;
//    const COST_3000 = 3000;
//
//    const WEIGHT_5 = 5;
//    public function getCost(int $weight): int
//    {
//        if($weight <= self::WEIGHT_10){
//            return self::COST_100;
//        } else {
//            return self::COST_1000;
//        }
//    }
//}