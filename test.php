<?php

require_once "vendor/autoload.php";

use Facebook\WebDriver\Remote\RemoteExecuteMethod;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverDimension;
use Facebook\WebDriver\WebDriverBy;

$host = 'http://localhost:4444/wd/hub'; // this is the default
$driver = RemoteWebDriver::create($host, \Facebook\WebDriver\Remote\DesiredCapabilities::chrome());

$size = new WebDriverDimension(1280, 900);
$driver->manage()->window()->setSize($size);
$driver->get('http://www.jd.com');

// id 查询
$input = $driver->findElement(
    WebDriverBy::id('key')
);
//往输入框填入元素
$input->sendKeys('iPhone 8');
// xpath 查询
$button = $input->findElement(
    WebDriverBy::xpath("../button[1]")
);
$button->click(); //单击按钮
//获取列表的 a 标签
$links = $driver->findElements(WebDriverBy::cssSelector(".goods-list > .p-img > a"));
$aTags = [];
foreach ($links as $value) {
    array_push($aTags, array(
        'href' => $value->getAttribute('href'),
        'title' => $value->getAttribute("title")
    ));
}
print_r($aTags);