# Imgecho

![tests](https://github.com/MilesChou/imgecho/workflows/tests/badge.svg)
[![codecov](https://codecov.io/gh/MilesChou/imgecho/branch/master/graph/badge.svg)](https://codecov.io/gh/MilesChou/imgecho)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/98319129f72f434c872277a13fb6b9b6)](https://www.codacy.com/gh/MilesChou/imgecho/dashboard)
[![Latest Stable Version](https://poser.pugx.org/MilesChou/imgecho/v/stable)](https://packagist.org/packages/MilesChou/imgecho)
[![Total Downloads](https://poser.pugx.org/MilesChou/imgecho/d/total.svg)](https://packagist.org/packages/MilesChou/imgecho)
[![License](https://poser.pugx.org/MilesChou/imgecho/license)](https://packagist.org/packages/MilesChou/imgecho)

Echo the image on iTerm App using [Inline Images Protocol](https://iterm2.com/documentation-images.html).

## Installation

Use Composer to install.

```
composer require mileschou/imgecho
```

## Usage

Use the fluent API to build your control code. Following is example:

```php
$uri = 'https://chart.apis.google.com/chart?cht=lc&chs=450x200&chd=t:70,72,67,68,65,59,64,70,73,75,78,80&chxt=x,y&chxl=0:|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec&chg=10,20';

$resolver = static function () use ($uri) {
    return file_get_contents($uri);
};

$echoer = new MilesChou\ImgEcho\ImgEcho();
$echoer->withName('basic');

$echoer->withImage($resolver);
$echoer->send();
```

![](/docs/images/basic-example.png)
