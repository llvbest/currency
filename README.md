реализовано на yii2 advanced, соответственно настроены хосты.
авторизация самая простая с коробки

Cодержит простой контроллер frontend\controllers\SiteController , 
и соответствующий вывод во вьюхе валют.

Модель Currency (\frontend\models\Currency.php) 
взято API приватбанка (вроде без лимитов) https://api.privatbank.ua/#p24/exchangeArchive
содержит всю бизнес логику рейтов валют (получаемые пары, период...)

вывод списка рейтов для авторизованных пользователей
 http://prntscr.com/u7bv0w  - для не залогиненых http://prntscr.com/u7bvul
 
база yii2 - dump ./yii2.sql
admin 123456
new 123456