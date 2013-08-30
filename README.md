farray
===========

fallen array

Install
-----

Add "kumatch/farray" as a dependency in your project's composer.json file.


    {
      "require": {
        "kumatch/farray": "*"
      }
    }

And install your dependencies.

    $ composer install

Usage
-----

```php
<?php
use Kumatch\Farray\Farray

$list = new Farray(array(10, 20)); // Farray extends ArrayObject

$a = $list[0];   // $a = 10
$b = $list[1];   // $b = 20

isset($list[2]);   // false
$c = $list[2];     // $c = null, and does not raise "undefinex index".


// farray creates recursively.
$list = new Farray(array("foo" => 10, "bar" => array(20)));

$foo = $list["foo"];     // 10
$bar = $list["bar"];     // farray instance
```

License
--------

Licensed under the MIT License.

Copyright (c) 2013 Yosuke Kumakura

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
