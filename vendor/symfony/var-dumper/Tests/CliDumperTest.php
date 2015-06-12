<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Tests;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Test\VarDumperTestCase;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class CliDumperTest extends VarDumperTestCase
{
    public function testGet()
    {
        require __DIR__.'/Fixtures/dumb-var.php';

        $dumper = new CliDumper('php://output');
        $dumper->setColors(false);
        $cloner = new VarCloner();
        $cloner->addCasters(array(
            ':stream' => function ($res, $a) {
                unset($a['uri']);

                return $a;
            },
        ));
        $data = $cloner->cloneVar($var);

        ob_start();
        $dumper->dump($data);
        $out = ob_get_clean();
        $out = preg_replace('/[ \t]+$/m', '', $out);
        $intMax = PHP_INT_MAX;
        $res1 = (int) $var['res'];
        $res2 = (int) $var[8];
        $closure54 = '';

        if (PHP_VERSION_ID >= 50400) {
            $closure54 = <<<EOTXT

    class: "Symfony\Component\VarDumper\Tests\CliDumperTest"
    this: Symfony\Component\VarDumper\Tests\CliDumperTest {#%d …}
EOTXT;
        }

        $this->assertStringMatchesFormat(
            <<<EOTXT
array:25 [
  "number" => 1
  0 => &1 null
  "const" => 1.1
  1 => true
  2 => false
  3 => NAN
  4 => INF
  5 => -INF
  6 => {$intMax}
  "str" => "déjà"
  7 => b"é@"
  "[]" => []
  "res" => :stream {@{$res1}
    wrapper_type: "plainfile"
    stream_type: "STDIO"
    mode: "r"
    unread_bytes: 0
    seekable: true
    timed_out: false
    blocked: true
    eof: false
    options: []
  }
  8 => :Unknown {@{$res2}}
  "obj" => Symfony\Component\VarDumper\Tests\Fixture\DumbFoo {#%d
    +foo: "foo"
    +"bar": "bar"
  }
  "closure" => Closure {#%d{$closure54}
    parameters: array:2 [
      "\$a" => []
      "&\$b" => array:2 [
        "typeHint" => "PDO"
        "default" => null
      ]
    ]
    file: "{$var['file']}"
    line: "{$var['line']} to {$var['line']}"
  }
  "line" => {$var['line']}
  "nobj" => array:1 [
    0 => &3 {#%d}
  ]
  "recurs" => &4 array:1 [
    0 => &4 array:1 [&4]
  ]
  9 => &1 null
  "sobj" => Symfony\Component\VarDumper\Tests\Fixture\DumbFoo {#%d}
  "snobj" => &3 {#%d}
  "snobj2" => {#%d}
  "file" => "{$var['file']}"
  b"bin-key-é" => ""
]

EOTXT
            ,
            $out
        );
    }

    public function testXmlResource()
    {
        if (!extension_loaded('xml')) {
            $this->markTestSkipped('xml extension is required');
        }

        $var = xml_parser_create();

        $this->assertDumpEquals(
            <<<EOTXT
:xml {
  current_byte_index: 0
  current_column_number: 1
  current_line_number: 1
  error_code: XML_ERROR_NONE
}
EOTXT
            ,
            $var
        );
    }

    public function testThrowingCaster()
    {
        $out = fopen('php://memory', 'r+b');

        $dumper = new CliDumper();
        $dumper->setColors(false);
        $cloner = new VarCloner();
        $cloner->addCasters(array(
            ':stream' => function () {
                throw new \Exception('Foobar');
            },
        ));
        $line = __LINE__ - 3;
        $file = __FILE__;
        $ref = (int) $out;

        $data = $cloner->cloneVar($out);
        $dumper->dump($data, $out);
        rewind($out);
        $out = stream_get_contents($out);

        $this->assertStringMatchesFormat(
            <<<EOTXT
:stream {@{$ref}
  wrapper_type: "PHP"
  stream_type: "MEMORY"
  mode: "w+b"
  unread_bytes: 0
  seekable: true
  uri: "php://memory"
  timed_out: false
  blocked: true
  eof: false
  options: []
  ⚠: Symfony\Component\VarDumper\Exception\ThrowingCasterException {#%d
    #message: "Unexpected Exception thrown from a caster: Foobar"
    trace: array:1 [
      0 => array:2 [
        "call" => "%s{closure}()"
        "file" => "{$file}:{$line}"
      ]
    ]
  }
}

EOTXT
            ,
            $out
        );
    }

    public function testRefsInProperties()
    {
        $var = (object) array('foo' => 'foo');
        $var->bar =& $var->foo;

        $dumper = new CliDumper();
        $dumper->setColors(false);
        $cloner = new VarCloner();

        $out = fopen('php://memory', 'r+b');
        $data = $cloner->cloneVar($var);
        $dumper->dump($data, $out);
        rewind($out);
        $out = stream_get_contents($out);

        $this->assertStringMatchesFormat(
            <<<EOTXT
{#%d
  +"foo": &1 "foo"
  +"bar": &1 "foo"
}

EOTXT
            ,
            $out
        );
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testSpecialVars56()
    {
        if (PHP_VERSION_ID < 50600) {
            $this->markTestSkipped('PHP 5.6 is required');
        }

        $var = $this->getSpecialVars();

        $this->assertDumpEquals(
            <<<EOTXT
array:3 [
  0 => array:1 [
    0 => &1 array:1 [
      0 => &1 array:1 [&1]
    ]
  ]
  1 => array:1 [
    "GLOBALS" => &2 array:1 [
      "GLOBALS" => &2 array:1 [&2]
    ]
  ]
  2 => &2 array:1 [&2]
]
EOTXT
            ,
            $var
        );
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testGlobalsNoExt()
    {
        $var = $this->getSpecialVars();
        unset($var[0]);
        $out = '';

        $dumper = new CliDumper(function ($line, $depth) use (&$out) {
            if ($depth >= 0) {
                $out .= str_repeat('  ', $depth).$line."\n";
            }
        });
        $dumper->setColors(false);
        $cloner = new VarCloner();

        $refl = new \ReflectionProperty($cloner, 'useExt');
        $refl->setAccessible(true);
        $refl->setValue($cloner, false);

        $data = $cloner->cloneVar($var);
        $dumper->dump($data);

        $this->assertSame(
            <<<EOTXT
array:2 [
  1 => array:1 [
    "GLOBALS" => &1 array:1 [
      "GLOBALS" => &1 array:1 [&1]
    ]
  ]
  2 => &1 array:1 [&1]
]

EOTXT
            ,
            $out
        );
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testBuggyRefs()
    {
        if (PHP_VERSION_ID >= 50600) {
            $this->markTestSkipped('PHP 5.6 fixed refs counting');
        }

        $var = $this->getSpecialVars();
        $var = $var[0];

        $dumper = new CliDumper();
        $dumper->setColors(false);
        $cloner = new VarCloner();

        $data = $cloner->cloneVar($var)->withMaxDepth(3);
        $out = '';
        $dumper->dump($data, function ($line, $depth) use (&$out) {
            if ($depth >= 0) {
                $out .= str_repeat('  ', $depth).$line."\n";
            }
        });

        $this->assertSame(
            <<<EOTXT
array:1 [
  0 => array:1 [
    0 => array:1 [
      0 => array:1 [ …1]
    ]
  ]
]

EOTXT
            ,
            $out
        );
    }

    private function getSpecialVars()
    {
        foreach (array_keys($GLOBALS) as $var) {
            if ('GLOBALS' !== $var) {
                unset($GLOBALS[$var]);
            }
        }

        $var = function &() {
            $var = array();
            $var[] =& $var;

            return $var;
        };

        return array($var(), $GLOBALS, &$GLOBALS);
    }
}
