<?php

namespace App\Database\Models;

interface Crud 
{
    function create();
    function read();
    function update();
    function delete();
}