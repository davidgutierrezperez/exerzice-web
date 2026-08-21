<?php 

namespace Application\Middleware;

interface Middleware {
    function execute(): void;
}