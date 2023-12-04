<?php
/**
 * Elasticsearch PHP Client
 *
 * @link      https://github.com/elastic/elasticsearch-php
 * @copyright Copyright (c) Elasticsearch B.V (https://www.elastic.co)
 * @license   https://opensource.org/licenses/MIT MIT License
 *
 * Licensed to Elasticsearch B.V under one or more agreements.
 * Elasticsearch B.V licenses this file to you under the MIT License.
 * See the LICENSE file in the project root for more information.
 */
declare(strict_types = 1);

namespace Elastic\Elasticsearch\Tests;

use Elastic\Elasticsearch\Utility;
use PHPUnit\Framework\TestCase;

class UtilityTest extends TestCase
{
    public function tearDown(): void
    {
        unset($_SERVER[Utility::ENV_URL_PLUS_AS_SPACE]);
        unset($_ENV[Utility::ENV_URL_PLUS_AS_SPACE]);
        putenv(Utility::ENV_URL_PLUS_AS_SPACE);
    }

    public function testGetEnvWithDollarServer()
    {
        $_SERVER[Utility::ENV_URL_PLUS_AS_SPACE] = 'true';
        $this->assertEquals('true', Utility::getEnv(Utility::ENV_URL_PLUS_AS_SPACE));
    }

    public function testGetEnvWithDollarEnv()
    {
        $_ENV[Utility::ENV_URL_PLUS_AS_SPACE] = 'true';
        $this->assertEquals('true', Utility::getEnv(Utility::ENV_URL_PLUS_AS_SPACE));
    }

    public function testGetEnvWithPutEnv()
    {
        putenv(Utility::ENV_URL_PLUS_AS_SPACE . '=true');
        $this->assertEquals('true', Utility::getEnv(Utility::ENV_URL_PLUS_AS_SPACE));
    }

    public function testUrlWithPlusAsDefault()
    {
        $url = Utility::urlencode('bar baz');
        $this->assertEquals('bar+baz', $url);
    }

    public function testUrlWithPlusWithDollarServer()
    {
        $_SERVER[Utility::ENV_URL_PLUS_AS_SPACE] = 'true';   
        $url = Utility::urlencode('bar baz');
        $this->assertEquals('bar+baz', $url);
    }

    public function testUrlWithPlusWithDollarEnv()
    {
        $_ENV[Utility::ENV_URL_PLUS_AS_SPACE] = 'true';   
        $url = Utility::urlencode('bar baz');
        $this->assertEquals('bar+baz', $url);
    }

    public function testUrlWithPlusWithPutEnv()
    {
        putenv(Utility::ENV_URL_PLUS_AS_SPACE . '=true');   
        $url = Utility::urlencode('bar baz');
        $this->assertEquals('bar+baz', $url);
    }

    public function testUrlWith2BWithDollarServer()
    {
        $_SERVER[Utility::ENV_URL_PLUS_AS_SPACE] = 'false';   
        $url = Utility::urlencode('bar baz');
        $this->assertEquals('bar%20baz', $url);
    }

    public function testUrlWith2BWithDollarEnv()
    {
        $_ENV[Utility::ENV_URL_PLUS_AS_SPACE] = 'false';   
        $url = Utility::urlencode('bar baz');
        $this->assertEquals('bar%20baz', $url);
    }

    public function testUrlWith2BWithPutEnv()
    {
        putenv(Utility::ENV_URL_PLUS_AS_SPACE . '=false');   
        $url = Utility::urlencode('bar baz');
        $this->assertEquals('bar%20baz', $url);
    }
}