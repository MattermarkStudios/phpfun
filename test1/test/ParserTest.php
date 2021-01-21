<?php

namespace ParserTest;

use PHPUnit\Framework\TestCase;
use Parser\Parser;

class ParserTest extends TestCase
{
    private $name = "American Estate & Trust";

    private $gtlt = "<tag>";

    private function escape (string $input) : string
    {
        return htmlentities($input);
    }

    private function addLayer(array $array) : array
    {
        return ["data" => $array];
    }

    public function testEscape()
    {
        //self check
        $escape = $this->escape($this->name);
        static::assertEquals("American Estate &amp; Trust", $escape);

        $doubleEscape = $this->escape($escape);
        static::assertEquals("American Estate &amp;amp; Trust", $doubleEscape);

        $tripleEscape = $this->escape($doubleEscape);
        static::assertEquals("American Estate &amp;amp;amp; Trust", $tripleEscape);
    }

    public function testCheckDecode()
    {
        $parser = new Parser();
        $checkName = $parser->checkDecoded($this->name);

        static::assertIsBool($checkName);
        static::assertTrue($checkName);

        $escape = $this->escape($this->name);

        $checkEscape = $parser->checkDecoded($escape);

        static::assertIsBool($checkEscape);
        static::assertFalse($checkEscape);
    }

    public function testHtmlDecode()
    {
        $parser = new Parser();
        $escape = $this->escape($this->name);
        $doubleEscape = $this->escape($escape);
        $tripleEscape = $this->escape($doubleEscape);
        $quadEscape = $this->escape($tripleEscape);
        $quintEscape = $this->escape($quadEscape);

        $plainResult = $parser->htmlDecode($this->name);
        static::assertEquals("American Estate & Trust", $plainResult);

        $escapeResult = $parser->htmlDecode($escape);
        static::assertEquals("American Estate & Trust", $escapeResult);

        $doubleResult = $parser->htmlDecode($doubleEscape);
        static::assertEquals("American Estate & Trust", $doubleResult);

        $tripleResult = $parser->htmlDecode($tripleEscape);
        static::assertEquals("American Estate & Trust", $tripleResult);

        $quadResult = $parser->htmlDecode($quadEscape);
        static::assertEquals("American Estate & Trust", $quadResult);

        $quintResult = $parser->htmlDecode($quintEscape);
        static::assertEquals("American Estate & Trust", $quintResult);

        $gtltResult = $parser->htmlDecode($this->gtlt);
        static::assertEquals("<tag>", $gtltResult);

        $gtltEscape = $this->escape($this->gtlt);
        $gtltEscapeResult = $parser->htmlDecode($gtltEscape);

        static::assertEquals("<tag", $gtltEscapeResult);
    }

    public function testLocate()
    {
        $parser = new Parser();

        $array = ["foo" => "bar"];
        $locate = $parser->locate($array, "foo");

        static::assertIsString($locate);
        static::assertEquals("bar", $locate);

        $layered = $this->addLayer($array);
        $layeredLocate = $parser->locate($layered, "foo");

        static::assertEquals("bar", $layeredLocate);

        $doubleLayered = $this->addLayer($layered);
        $doubleLocate = $parser->locate($doubleLayered, "foo");

        static::assertEquals("bar", $doubleLocate);

        $tripleLayered = $this->addLayer($doubleLayered);
        $tripleLocate = $parser->locate($tripleLayered, "foo");

        static::assertEquals("bar", $tripleLocate);

        $quadLayered = $this->addLayer($tripleLayered);
        $quadLocate = $parser->locate($quadLayered, "foo");

        static::assertEquals("bar", $quadLocate);

        $quintLayered = $this->addLayer($quadLayered);
        $quintLocate = $parser->locate($quintLayered, "foo");

        static::assertEquals("bar", $quintLocate);
    }

    public function testSortDate()
    {
        $parser = new Parser();

        $a = ["creation_date" => "09/20/2020 00:00:00"];
        $b = ["creation_date" => "2020-10-10 00:00:00"];

        $compareAB = $parser->sortDate($a, $b);
        static::assertEquals(-1, $compareAB);
    }

    public function testParse()
    {
        $data = '[
            {
                "text":"American Estate &amp;amp; Trust is a great company to work.",
                "creation_date":"2020-10-01 00:00:00"
            },
            {
                "id":3,
                "data":{
                    "text":"American Estate &amp;amp; Trust is a fun place to play tetris."
                },
                "creation_date":"2020-09-09 00:00:00"
            },
            {
                "response":{
                    "layer":"foo",
                    "data":{
                        "text":"American Estate &amp; Trust is a &lt; racoon friendly &gt; workplace.",
                        "creation_date":"2021-01-01 00:00:00"
                    }
                }
            }
        ]';


        $parser = new Parser();
        $parsed = $parser->parse($data);

        static::assertIsArray($parsed);

        $first = array_pop($parsed);

        static::assertIsArray($first);
        if (is_array($first)) {
            static::assertArrayHasKey("creation_date", $first);
            if (array_key_exists("creation_date", $first)) {
                static::assertEquals("2020-09-09 00:00:00", $first["creation_date"]);
            }
        }
    }
}
