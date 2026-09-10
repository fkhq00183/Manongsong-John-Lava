<?php
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 4
 */

class Middleware
{
    protected $map = [];

    public function __construct()
    {
        $config = get_config();

        if (!isset($config['middlewares'])) {
            throw new RuntimeException('Middleware config not found.');
        }

        $this->map = $config['middlewares'];
    }

    /**
     * Run the middleware pipeline
     */
    public function run(array $middlewares, Closure $destination)
    {
        $pipeline = array_reduce(
            array_reverse($middlewares),
            function (Closure $next, string $middleware): Closure {
                return function () use ($middleware, $next) {
                    return $this->resolve($middleware, $next);
                };
            },
            $destination
        );

        return $pipeline();
    }

    /**
     * Resolve a middleware
     */
    protected function resolve(string $middleware, Closure $next)
    {
        if (!isset($this->map[$middleware])) {
            throw new Exception(
                "Middleware [$middleware] not registered."
            );
        }

        $class = $this->map[$middleware];

        // Create the middleware object
        if (is_string($class)) {
            if (!class_exists($class)) {
                throw new Exception(
                    "Middleware class [$class] not found."
                );
            }

            $class = new $class();
        }

        // Make sure it has a handle() method
        if (!method_exists($class, 'handle')) {
            throw new Exception(
                "Middleware [$middleware] must have a handle() method."
            );
        }

        return $class->handle($next);
    }
}