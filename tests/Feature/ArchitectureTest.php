<?php

uses()->group('architecture');

test('avoid dd, dump, ds, ray, var_dump')
    ->expect(['dd', 'dump', 'ds', 'ray', 'var_dump'])
    ->not->toBeUsed();
