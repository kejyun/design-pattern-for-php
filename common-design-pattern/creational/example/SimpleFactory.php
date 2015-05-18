<?php

/**
 * 抽象"烹煮"類別
 */
abstract class Cook {
    // 準備食材
    public abstract function prepareIngredient();
    // 烹煮食材
    public abstract function cooking();
    // 上菜
    public abstract function serve(); 
}

/**
 * 咖哩
 */
class Curry extends Cook
{   
    // 準備食材
    public function prepareIngredient()
    {
        echo "準備「馬鈴薯」、「蘿蔔」、「洋蔥」、「肉」\n";
    }
    
    // 烹煮食材
    public function cooking()
    {
        echo "下鍋炒肉，等肉熟之後，將「馬鈴薯」、「蘿蔔」、「洋蔥」加到鍋裡並加滿水，等水滾加入咖哩塊悶熟即可\n";
    }
    
    // 上菜
    public function serve()
    {
        echo "盤子放上白飯，將咖哩淋在白飯周圍即可\n";
    }
}

$curry = new Curry;
$curry->prepareIngredient();
$curry->cooking();
$curry->serve();

/**
 * 三明治
 */
class Sandwich extends Cook
{
    // 準備食材
    public function prepareIngredient()
    {
        echo "準備「吐司」、「生菜」、「小黃瓜」、「蛋」、「肉」\n";
    }

    // 烹煮食材
    public function cooking()
    {
        echo "將蛋及肉煎熟、生菜及小黃瓜切絲，平均放在烤好的土司上夾起來\n";
    }

    // 上菜
    public function serve()
    {
        echo "吐司對切放在盤子上即可\n";
    }
}

$sandwich = new Sandwich;
$sandwich->prepareIngredient();
$sandwich->cooking();
$sandwich->serve();



/**
 * 廚師工廠
 */
class ChefFactory
{
    /**
     * 聘請廚師
     */
    public static function hireChef($meal)
    {
        switch ($meal) {
            // 咖哩廚師
            case 'curry':
                return new Curry();
                break;
            // 三明治廚師
            case 'sandwich':
                return new Sandwich();
                break;
        }
    }
}

/**
 * 餐廳
 */
class Restaurant
{
    public function order($meal)
    {
        // 透過廚師工廠，聘請會煮這道餐點的廚師
        $chef = ChefFactory::hireChef($meal);

        // 烹煮食物
        $chef->prepareIngredient();
        $chef->cooking();
        $chef->serve();
    }
}

// 到餐廳用餐
$restaurant = new Restaurant;
// 點餐：咖哩
$restaurant->order('curry');
// 點餐：三明治
$restaurant->order('sandwich');