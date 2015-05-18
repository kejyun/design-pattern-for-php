# 簡單工廠（Simple Factory）

我們如果想要煮東西給自己吃，我們需要自己「準備食材」、「烹煮食材」、「上菜」

```php
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
?>
```

假如我們想要吃咖哩，我們會這樣做：


```php
<?php
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
$curry->prepareIngredient();    // 準備食材
$curry->cooking();              // 烹煮食材
$curry->serve();                // 上菜
?>
```

我們會得到這樣的結果：

```
準備「馬鈴薯」、「蘿蔔」、「洋蔥」、「肉」
下鍋炒肉，等肉熟之後，將「馬鈴薯」、「蘿蔔」、「洋蔥」加到鍋裡並加滿水，等水滾加入咖哩塊悶熟即可
盤子放上白飯，將咖哩淋在白飯周圍即可
```

假如我們想要吃三明治，我們會這樣做：

```php
<?php
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
?>
```

我們會得到這樣的結果：

```
準備「吐司」、「生菜」、「小黃瓜」、「蛋」、「肉」
將蛋及肉煎熟、生菜及小黃瓜切絲，平均放在烤好的土司上夾起來
吐司對切放在盤子上即可
```

所有我們想要吃的東西，我們通通都需要經過一樣的步驟（「準備食材」、「烹煮食材」、「上菜」）去達成，因為每次想要吃個東西都需要時間來做這些菜，假如我們比較沒有時間，想要到外面餐廳去用餐，我們會這樣做：

```php
<?php
// 到餐廳用餐
$restaurant = new Restaurant;
// 點餐：咖哩
$restaurant->order('curry');
// 點餐：三明治
$restaurant->order('sandwich');
?>
```

所以我們需要餐廳來讓我們有這些食物可以吃，所以我們有了餐廳：

```php
<?php
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
?>
```

餐廳會提供他們的餐點讓我們點，而他們的餐點需要特定的廚師才會烹煮，所以當客人點了餐，餐廳會透過「廚師工廠」聘請該廚師去烹煮餐點：


```php
<?php
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
?>
```

我們會得到這樣的結果：

```
準備「馬鈴薯」、「蘿蔔」、「洋蔥」、「肉」
下鍋炒肉，等肉熟之後，將「馬鈴薯」、「蘿蔔」、「洋蔥」加到鍋裡並加滿水，等水滾加入咖哩塊悶熟即可
盤子放上白飯，將咖哩淋在白飯周圍即可

準備「吐司」、「生菜」、「小黃瓜」、「蛋」、「肉」
將蛋及肉煎熟、生菜及小黃瓜切絲，平均放在烤好的土司上夾起來
吐司對切放在盤子上即可
```

這樣我們就可以把烹煮這個重複且繁瑣的工作交給餐廳及廚師工廠去處理了！

